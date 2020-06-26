<?php
declare(strict_types=1);

namespace App\CS\Sniffs\PossibleBugs;

use InvalidArgumentException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class AntiXssSniff implements Sniff
{
    //tokeny ktore preskakujem (bodky, medzery, ..)
    public const ALLOWED_TOKENS = [
        T_CONSTANT_ENCAPSED_STRING,
        T_COMMENT,
        T_WHITESPACE,
        T_STRING_CONCAT,
        T_OPEN_PARENTHESIS,
        T_LNUMBER,
        T_SEMICOLON,
    ];

    public $safeFunctions = [
        'h' => true,
        'ne' => true,
        'json_encode' => true,
        '$this->element' => true,
        '$this->Element' => true,
        '$this->cell' => true,
        '$this->fetch' => true,
        '$this->Breadcrumbs' => true,
        '$this->Customer' => true,
        '$this->Flash' => true,
        '$this->Form' => true,
        '$this->B3Form' => true,
        '$this->Html' => true,
        '$this->Number' => true,
        '$this->Paginator' => true,
        '$this->Text' => true,
        '$this->Time' => true,
        '$this->Url' => true,
        '$this->Product' => true,
        '$this->Cart' => true,
        '$this->Ad' => true,
        '$this->Asset' => true,
        '$this->Pbx' => true,
        '$this->Meta' => true,
        '$this->LB' => true,
        '$this->Address' => true,
    ];

    public function register()
    {
        return [T_ECHO, T_OPEN_TAG_WITH_ECHO,];
    }

    /**
     * Prejde celý echo statement, ak nájde $variable neobalené do safe funkcie (h(), $this->Html->...),
     * tak nahlási error.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
     *                                               token was found.
     * @param int $stackPtr The position in the PHP_CodeSniffer
     *                                               file's token stack where the token
     *                                               was found.
     * @return void|int Optionally returns a stack pointer. The sniff will not be
     *                  called again on the current file until the returned stack
     *                  pointer is reached. Return (count($tokens) + 1) to skip
     *                  the rest of the file.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $end = $phpcsFile->findEndOfStatement($stackPtr) + 1; //+1 lebo od nuly
        $tokens = array_slice($tokens, $stackPtr, $end - $stackPtr);

        $whitespace = $tokens[1];

        if ($whitespace['code'] !== T_WHITESPACE || $whitespace['content'] !== ' ') {
            $phpcsFile->addError('Echo must be followed by 1 whitespace', $stackPtr + 1, 'NoWhitespace');
        } else {
            $max = count($tokens);
            $skipUntil = null;
            $isThis = false;
            $insideFunction = 0;
            for ($i = 1; $i < $max; $i++) {
                if ($skipUntil && $i < $skipUntil) {
                    continue;
                }

                $next = $tokens[$i];

                if ($next['code'] == T_OPEN_PARENTHESIS) {
                    $insideFunction++;
                } elseif ($next['code'] == T_CLOSE_PARENTHESIS) {
                    $insideFunction--;
                }

                if ($next['code'] == T_VARIABLE && $next['content'] == '$this') {
                    //ak je $this->Helper metoda
                    $function = $next['content'] . $tokens[$i + 1]['content'] . $tokens[$i + 2]['content'];
                    $isThis = true;
                } elseif ($next['code'] == T_STRING || $next['code'] == T_COMMENT) {
                    $function = $next['content'];
                } elseif (in_array($next['code'], self::ALLOWED_TOKENS)) {
                    continue;
                } else {
                    $function = '';
                }

                $config = !empty($this->safeFunctions[$function]) ? $this->safeFunctions[$function] : false;

                if (is_bool($config)) {
                    $isSafe = $config;
                } elseif (is_callable($config)) {
                    $isSafe = $config($tokens, $i);
                } elseif (is_bool($config)) {
                    $isSafe = $config;
                } else {
                    throw new InvalidArgumentException(
                        "Config for function {$function} is of type " . gettype($config) .
                        ", only bool or callable is allowed"
                    );
                }

                if ($isSafe) {
                    //skip content of safe function
                    if ($isThis) {
                        $parenthesisToken = $this->getNearestParenthis($tokens, $i);
                    } else {
                        $parenthesisToken = $tokens[$i + 1];
                    }

                    if (!empty($parenthesisToken['parenthesis_closer'])) {
                        //najdem koniec safe funkcie a skipnem tokeny do konca
                        $skipUntil = $parenthesisToken['parenthesis_closer'] - $stackPtr;
                        continue;
                    }
                } else {
                    //ak nie je fcia safe, skontrolujem ci obsahuje variables
                    if ($this->isVariable($next)) {
                        $endOfObject = $this->getEndOfObject($tokens, $i);
                        $errorFunction = ($insideFunction ? 'addError' : 'addFixableError');
                        $fix =
                            $phpcsFile->$errorFunction(
                                'Unescaped echo found, potential XSS',
                                $stackPtr + $i,
                                'UnescapedVariable'
                            );
                        //fixujem len v pripade, ze nie som vo vnutri funkcie (argumenty fcii, anonymne funkcie, ..)
                        if ($fix === true && !$insideFunction) {
                            $phpcsFile->fixer->beginChangeset();
                            $phpcsFile->fixer->addContentBefore($stackPtr + $i, 'h(');
                            $phpcsFile->fixer->addContent($stackPtr + $endOfObject - 1, ')');
                            $phpcsFile->fixer->endChangeset();
                        }
                        // return;
                    }
                }
            }
        }
    }

    /**
     * Najde koniec premennej / objektu
     * * $variable['i']
     * * $object->next->next
     * * etc..
     *
     * @param array $tokens
     * @param int $stackPtr
     * @return int
     */
    private function getEndOfObject($tokens, $stackPtr)
    {
        $max = count($tokens);
        for ($i = $stackPtr; $i < $max; $i++) {
            $token = $tokens[$i];
            if (
                in_array(
                    $token['code'],
                    [
                    T_OBJECT_OPERATOR,
                    T_CONSTANT_ENCAPSED_STRING,
                    T_WHITESPACE,
                    T_LINE,
                    T_STRING,
                    T_VARIABLE,
                    T_OPEN_SQUARE_BRACKET,
                    T_CLOSE_SQUARE_BRACKET,
                    T_OPEN_CURLY_BRACKET,
                    T_CLOSE_CURLY_BRACKET,
                    T_OPEN_PARENTHESIS,
                    T_CLOSE_PARENTHESIS,
                    ]
                )
            ) {
                continue;
            }

            return $i;
        }

        return $max;
    }

    private function getNearestParenthis($tokens, $stackPtr)
    {
        $max = count($tokens);
        for ($i = $stackPtr; $i < $max; $i++) {
            $token = $tokens[$i];
            if (in_array($token['code'], [T_OPEN_PARENTHESIS])) {
                return $token;
            }
        }

        return null;
    }

    private function isVariable($token)
    {
        return in_array($token['code'], [T_VARIABLE]) || //premenna
            //premenna v dvojitych uvodzovkach
            ($token['code'] == T_DOUBLE_QUOTED_STRING && strpos($token['content'], '$'));
    }
}
