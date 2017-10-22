<?php

namespace Canvas\Helpers;

use ConfigWriter;

class ConfigHelper extends CanvasHelper
{
    // Config
    const FILENAME = 'blog.php';

    /**
     * Get config writer instance.
     */
    public static function getWriter()
    {
        return new ConfigWriter(basename(self::FILENAME, '.php'));
    }
}
