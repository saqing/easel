<?php

namespace Canvas\Extensions;

use Canvas\Contracts\Annex;
use Illuminate\Contracts\Support\Arrayable;

/**
 * An Extension. Adapted from Flarum.
 */
class Extension implements Arrayable, Annex
{
    /**
     * Unique Id of the extension.
     *
     * @info    Identical to the directory in the extensions directory.
     * @example canvas_suspend
     *
     * @var string
     */
    protected $id;

    /**
     * The directory of this extension.
     *
     * @var string
     */
    protected $path;

    /**
     * Composer json of the package.
     *
     * @var array
     */
    protected $composerJson;

    /**
     * Whether the extension is installed.
     *
     * @var bool
     */
    protected $installed = true;

    /**
     * The installed version of the extension.
     *
     * @var string
     */
    protected $version;

    /**
     * Whether the extension is enabled.
     *
     * @var bool
     */
    protected $enabled = false;

    /**
     * @param       $path
     * @param array $composerJson
     */
    public function __construct($path, $composerJson)
    {
        $this->path = $path;
        $this->composerJson = $composerJson;
        $this->assignId();
    }

    /**
     * Assigns the id for the extension used globally.
     */
    protected function assignId()
    {
        list($vendor, $package) = explode('/', $this->name);
        $package = str_replace(['canvas-ext-', 'canvas-theme-', 'canvas-'], '', $package);
        $this->id = "$vendor-$package";
    }

    /**
     * {@inheritdoc}
     */
    public function __get($name)
    {
        return $this->composerJsonAttribute(snake_case($name, '-'));
    }

    /**
     * {@inheritdoc}
     */
    public function __isset($name)
    {
        return isset($this->{$name}) || $this->composerJsonAttribute(snake_case($name, '-'));
    }

    /**
     * Dot notation getter for composer.json attributes.
     *
     * @see https://laravel.com/docs/5.1/helpers#arrays
     *
     * @param $name
     * @return mixed
     */
    public function composerJsonAttribute($name)
    {
        return array_get($this->composerJson, $name);
    }

    /**
     * @param bool $installed
     * @return Extension
     */
    public function setInstalled($installed)
    {
        $this->installed = $installed;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInstalled()
    {
        return $this->installed;
    }

    /**
     * @param string $version
     * @return Extension
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        $version = $this->version;
        $dist = $this->__get('dist');
        if (substr($version, 0, 4) === 'dev-') {
            $version .= ' '.substr($dist['reference'], 0, 12);
        }

        return $version;
    }

    /**
     * Get a property from canvas-extension section of extension json.
     * @return string
     */
    public function getExtensionProperty($prop)
    {
        return $this->composerJsonAttribute("extra.canvas-extension.$prop");
    }

    /**
     * Loads the icon information from the composer.json.
     *
     * @return array|null
     */
    public function getIcon()
    {
        if (($icon = $this->getExtensionProperty('icon'))) {
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
     * @param bool $enabled
     * @return Extension
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * The raw path of the directory under extensions.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The readable name for the extension.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getExtensionProperty('title') ?: $this->getId();
    }

    public function getName()
    {
        return $this->getTitle();
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getComposerJson()
    {
        return $this->composerJson;
    }

    /**
     * Tests whether the extension has assets.
     *
     * @return bool
     */
    public function hasAssets()
    {
        return realpath($this->path.'/assets/') !== false;
    }

    /**
     * Tests whether the extension has migrations.
     *
     * @return bool
     */
    public function hasMigrations()
    {
        return realpath($this->path.'/migrations/') !== false;
    }

    /**
     * Generates an array result for the object.
     *
     * @return array
     */
    public function toArray()
    {
        return (array) array_merge($this->composerJson, [
            'id'            => $this->getId(),
            'name'          => $this->getName(),
            'version'       => $this->getVersion(),
            'path'          => $this->getPath(),
            'enabled'       => $this->isEnabled(),
            'icon'          => $this->getIcon(),
            'hasAssets'     => $this->hasAssets(),
            'hasMigrations' => $this->hasMigrations(),
        ]);
    }
}
