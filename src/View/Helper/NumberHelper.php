<?php
declare(strict_types=1);

namespace App\View\Helper;

class NumberHelper extends \Cake\View\Helper\NumberHelper
{
    /**
     * @param float $number
     * @param string|null $currency
     * @param array<mixed> $options
     * @return string
     */
    public function currency($number, ?string $currency = null, array $options = []): string
    {
        $options += [
            'places' => 0,
            'locale' => 'sk_SK',
        ];
        if ($number > 0) {
            $options['before'] = '+ ';
        }
        $currency = $currency ?: 'EUR';

        return parent::currency($number, $currency, $options);
    }

    /**
     * @param float|string $number
     * @param int $precision
     * @param array<mixed> $options
     * @return string
     */
    public function toPercentage($number, int $precision = 2, array $options = []): string
    {
        $precision = 0;
        $options['multiply'] = true;
        $percentage = parent::toPercentage($number, $precision, $options);
        if ($number > 0) {
            $percentage = '+' . $percentage;
        }

        return $percentage;
    }
}
