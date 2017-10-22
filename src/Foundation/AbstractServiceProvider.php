<?php

namespace Canvas\Foundation;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

abstract class AbstractServiceProvider extends ServiceProvider
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }
}
