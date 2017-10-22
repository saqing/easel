<?php

namespace Canvas\Contracts;

/**
 * An extension or subsidiary part.
 */
interface Annex
{
    /**
     * Dot notation getter for composer.json attributes.
     *
     * @see https://laravel.com/docs/5.1/helpers#arrays
     *
     * @param $name
     * @return mixed
     */
    public function composerJsonAttribute($name);

    /**
     * The raw path of the directory under extensions.
     *
     * @return string
     */
    public function getId();

    /**
     * The readable name for the Annex.
     *
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getPath();

    /**
     * The readable name for the Annex.
     *
     * @return string
     */
    public function getTitle();

    /**
     * @return string Version
     */
    public function getVersion();

    /**
     * Get a property from canvas-extension section of extension json.
     * @param string $prop Property name.
     * @return string
     */
    public function getExtensionProperty($prop);

    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @return bool
     */
    public function isInstalled();

    /**
     * @param bool $enabled
     * @return Extension
     */
    public function setEnabled($enabled);

    /**
     * @param bool $installed
     */
    public function setInstalled($installed);

    /**
     * @param string $version
     * @return Annex
     */
    public function setVersion($version);
}
