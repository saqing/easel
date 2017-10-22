<?php

namespace Canvas\Extensions;

use Canvas\Foundation\AbstractServiceProvider;

class ExtensionsServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->bind('canvas.extensions', 'Canvas\Extensions\ExtensionManager');

        $bootstrappers = $this->app->make('canvas.extensions')->getEnabledBootstrappers();

        foreach ($bootstrappers as $file) {
            $bootstrapper = require $file;

            $this->app->call($bootstrapper);
        }
    }
}
