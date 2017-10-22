<?php

namespace Canvas\Extensions;

use Canvas\Contracts\Annex;
use Illuminate\Contracts\Support\Arrayable;

/**
 * An Extension. Adopted from Flarum.
 */
class Theme extends Extension implements Arrayable, Annex
{
    /**
     * @constant(SOURCE_DIRS)
     */
    const SOURCE_DIRS = [
        'public' => 'public',
        'views'  => 'resources/views',
    ];

    /**
     * The readable name for the extension.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getThemeProperty('title') ?: $this->getId();
    }

    /**
     * Get a property from canvas-theme or canvas-extension section of extension json.
     * @return string
     */
    public function getExtensionProperty($prop)
    {
        return $this->composerJsonAttribute("extra.canvas-theme.$prop") ?: $this->composerJsonAttribute("extra.canvas-extension.$prop");
    }

    /**
     * Get a property from canvas-theme section of extension json.
     * @return string
     */
    public function getThemeProperty($prop)
    {
        return $this->getExtensionProperty($prop);
    }

    /**
     * Loads the icon information from the composer.json.
     *
     * @return array|null
     */
    public function getIcon()
    {
        if (($icon = $this->getThemeProperty('icon'))) {
            if ($file = array_get($icon, 'image')) {
                $file = $this->path.'/'.$file;

                if (file_exists($file)) {
                    $mimetype = pathinfo($file, PATHINFO_EXTENSION) === 'svg'
                        ? 'image/svg+xml'
                        : finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
                    $data = file_get_contents($file);

                    $icon['backgroundImage'] = 'url(\'data:'.$mimetype.';base64,'.base64_encode($data).'\')';
                }
            }

            return $icon;
        }
    }

    /**
     * Get source directories to be published.
     */
    public function getSourceDirectories()
    {
        return array_map(function ($directory) {
            return "{$this->getPath()}/$directory";
        }, $this->getExtensionProperty('directories') ?: self::SOURCE_DIRS);
    }

    /**
     * Get themes public directory.
     */
    public function getPublicDirectory()
    {
        return $this->getSourceDirectories()['public'];
    }

    /**
     * Get themes views directory.
     */
    public function getViewsDirectory()
    {
        return $this->getSourceDirectories()['views'];
    }
}
