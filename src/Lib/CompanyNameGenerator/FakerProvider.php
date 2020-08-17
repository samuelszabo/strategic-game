<?php
declare(strict_types=1);

namespace App\Lib\CompanyNameGenerator;

use Faker\Provider\Base;

class FakerProvider extends Base
{
    /**
     * @var array|string[]
     */
    protected static array $techTerms = [
        'AddOn',
        'Algorithm',
        'Architect',
        'Array',
        'Asynchronous',
        'Avatar',
        'Band',
        'Base',
        'Beta',
        'Binary',
        'Blog',
        'Board',
        'Boolean',
        'Boot',
        'Bot',
        'Browser',
        'Bug',
        'Cache',
        'Character',
        'Checksum',
        'Chip',
        'Circuit',
        'Client',
        'Cloud',
        'Cluster',
        'Code',
        'Codec',
        'Coder',
        'Column',
        'Command',
        'Compile',
        'Compression',
        'Computing',
        'Console',
        'Constant',
        'Control',
        'Cookie',
        'Core',
        'Cyber',
        'Default',
        'Deprecated',
        'Dev',
        'Developer',
        'Development',
        'Device',
        'Digital',
        'Domain',
        'Dynamic',
        'Emulation',
        'Encryption',
        'Engine',
        'Error',
        'Exception',
        'Exploit',
        'Export',
        'Extension',
        'File',
        'Font',
        'Fragment',
        'Frame',
        'Function',
        'Group',
        'Hacker',
        'Hard',
        'HTTP',
        'Icon',
        'Input',
        'IT',
        'Kernel',
        'Key',
        'Leak',
        'Link',
        'Load',
        'Logic',
        'Mail',
        'Mashup',
        'Mega',
        'Meme',
        'Memory',
        'Meta',
        'Mount',
        'Navigation',
        'Net',
        'Node',
        'Open',
        'OS',
        'Output',
        'Over',
        'Packet',
        'Page',
        'Parallel',
        'Parse',
        'Path',
        'Phone',
        'Ping',
        'Pixel',
        'Port',
        'Power',
        'Programmers',
        'Programs',
        'Protocol',
        'Push',
        'Query',
        'Queue',
        'Raw',
        'Real',
        'Repository',
        'Restore',
        'Root',
        'Router',
        'Run',
        'Safe',
        'Sample',
        'Scalable',
        'Script',
        'Server',
        'Session',
        'Shell',
        'Smart',
        'Socket',
        'Soft',
        'Solid',
        'Sound',
        'Source',
        'Streaming',
        'Symfony',
        'Syntax',
        'System',
        'Tag',
        'Tape',
        'Task',
        'Template',
        'Thread',
        'Token',
        'Tool',
        'Tweak',
        'URL',
        'Utility',
        'Viral',
        'Volume',
        'Ware',
        'Web',
        'Wiki',
        'Window',
        'Wire',
    ];

    /**
     * @var array|string[]
     */
    protected static array $culinaryTerms = [
        'Appetit',
        'Bake',
        'Beurre',
        'Bistro',
        'Blend',
        'Boil',
        'Bouchees',
        'Brew',
        'Buffet',
        'Caffe',
        'Caffeine',
        'Cake',
        'Caviar',
        'Chef',
        'Chocolate',
        'Chop',
        'Citrus',
        'Compote',
        'Cool',
        'Core',
        'Course',
        'Cuisine',
        'Dash',
        'Dessert',
        'Dip',
        'Dish',
        'Dress',
        'Entree',
        'Espresso',
        'Fold',
        'Fruit',
        'Glucose',
        'Gourmet',
        'Greens',
        'Guacamole',
        'Herbs',
        'Honey',
        'Hybrid',
        'Ice',
        'Instant',
        'Jasmine',
        'Jelly',
        'Juice',
        'Kiwi',
        'Lean',
        'Leek',
        'Legumes',
        'Lemon',
        'Lime',
        'Liqueur',
        'Mango',
        'Marinate',
        'Melon',
        'Mill',
        'Mince',
        'Mix',
        'Mousse',
        'Muffin',
        'Nectar',
        'Nut',
        'Olive',
        'Organic',
        'Pan',
        'Pasta',
        'Pate',
        'Peanut',
        'Pear',
        'Pesto',
        'Picante',
        'Pie',
        'Pigment',
        'Plate',
        'Plum',
        'Pod',
        'Prepare',
        'Pressure',
        'Pudding',
        'Pulp',
        'Quiche',
        'Rack',
        'Raft',
        'Raisin',
        'Recipe',
        'Reduce',
        'Relish',
        'Render',
        'Risotto',
        'Rosemary',
        'Roux',
        'Rub',
        'Salad',
        'Salsa',
        'Sauce',
        'Sauté',
        'Season',
        'Slice',
        'Smoked',
        'Soft',
        'Sorbet',
        'Soup',
        'Spaghetti',
        'Specialty',
        'Spicy',
        'Splash',
        'Steam',
        'Stem',
        'Sticky',
        'Stuff',
        'Sugar',
        'Supreme',
        'Sushi',
        'Sweet',
        'Table',
        'Tart',
        'Taste',
        'Tasting',
        'Tea',
        'Tender',
        'Terrine',
        'Tomato',
        'Vanilla',
        'Wash',
        'Wax',
        'Wine',
        'Wok',
        'Zest',
    ];

    /**
     * @var string[]
     */
    private static $epithetTerms = [
        'Nudná',
        'Veselá',
        'Hravá',
        'Voňavá',
        'Dnešná',
        'Iná',
        'Nová',
        'Stará',
    ];

    /**
     * @var string[]
     */
    private static $nameEpithetTerms = [
        'Jožova',
        'Majkina',
        'Miškina',
        'Jankina',
        'Peťova',
        'Moja',
        'Čierna',
        'Biela',
    ];

    /**
     * @var string[]
     */
    private static $femaleSubjectTerms = [
        'Pláž',
        'Vec',
        'Zábava',
        'Doska',
    ];

    /**
     * @var string[]
     */
    private static $maleSubjectTerms = [
        'Piesok',
        'Pohár',
        'Slnečník',
        'Banán',
        'Kvet',
    ];

    /**
     * @var string[]
     */
    private static $otherSubjectTerms = [
        'Drevo',
        'Hrozno',
    ];

    /**
     * @var array|string[]
     */
    protected static array $companyNameFormats = [
//        '{{techTerm}}{{culinaryTerm}}',
//        '{{techTerm}}{{techTerm}}',
        '{{culinaryTerm}}{{culinaryTerm}}',
        '{{femaleEpithetTerm}}{{femaleSubjectTerm}}',
        '{{maleEpithetTerm}}{{maleSubjectTerm}}',
//        '{{otherEpithetTerm}}{{otherSubjectTerm}}',

        '{{femaleNameEpithetTerm}}{{femaleSubjectTerm}}',
        '{{maleNameEpithetTerm}}{{maleSubjectTerm}}',
        //      '{{otherNameEpithetTerm}}{{otherSubjectTerm}}',
    ];

    /**
     * @return mixed|null
     */
    public static function femaleEpithetTerm()
    {
        return mb_substr(static::randomElement(static::$epithetTerms), 0, -1) . 'á';
    }

    /**
     * @return mixed|null
     */
    public static function maleEpithetTerm()
    {
        return mb_substr(static::randomElement(static::$epithetTerms), 0, -1) . 'ý';
    }

    /**
     * @return mixed|null
     */
    public static function otherEpithetTerm()
    {
        return mb_substr(static::randomElement(static::$epithetTerms), 0, -1) . 'é';
    }

    /**
     * @return mixed|null
     */
    public static function femaleNameEpithetTerm()
    {
        return mb_substr(static::randomElement(static::$nameEpithetTerms), 0, -1) . 'a';
    }

    /**
     * @return mixed|null
     */
    public static function maleNameEpithetTerm()
    {
        return mb_substr(static::randomElement(static::$nameEpithetTerms), 0, -1) . '';
    }

    /**
     * @return mixed|null
     */
    public static function otherNameEpithetTerm()
    {
        return mb_substr(static::randomElement(static::$nameEpithetTerms), 0, -1) . 'e';
    }

    /**
     * @return mixed|null
     */
    public static function maleSubjectTerm()
    {
        return static::randomElement(static::$maleSubjectTerms);
    }

    /**
     * @return mixed|null
     */
    public static function femaleSubjectTerm()
    {
        return static::randomElement(static::$femaleSubjectTerms);
    }

    /**
     * @return mixed|null
     */
    public static function otherSubjectTerm()
    {
        return static::randomElement(static::$otherSubjectTerms);
    }

    /**
     * @return mixed|null
     */
    public static function techTerm()
    {
        return static::randomElement(static::$techTerms);
    }

    /**
     * @return mixed|null
     */
    public static function culinaryTerm()
    {
        return static::randomElement(static::$culinaryTerms);
    }

    /**
     * @return string
     */
    public function companyName()
    {
        $format = static::randomElement(static::$companyNameFormats);

        return $this->generator->parse($format);
    }
}
