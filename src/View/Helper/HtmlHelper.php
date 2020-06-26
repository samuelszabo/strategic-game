<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\Log\Log;

class HtmlHelper extends \Cake\View\Helper\HtmlHelper
{
    /**
     * Get the path to a versioned asset file.
     *
     * @param string $file
     * @return string
     */
    public function versionedUrl($file): string
    {
        // eventually implement this nicer, but works for now
        static $manifest = null;
        if (is_null($manifest)) {
            $manifestFile = ROOT . DS . 'webroot' . DS . 'js' . DS . 'manifest.json';

            if (file_exists($manifestFile)) {
                $manifest = json_decode(file_get_contents($manifestFile), true);
            } else {
                Log::error("Failed to load manifest.json file (looking for it here: {$manifestFile}), assets will not be versioned");
                $manifest = [];
            }
        }

        if (isset($manifest[$file])) {
            return $manifest[$file];
        }

        return $file;
    }
}
