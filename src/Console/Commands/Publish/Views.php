<?php

namespace Canvas\Console\Commands\Publish;

use Artisan;
use Canvas\Console\Commands\CanvasCommand;

class Views extends CanvasCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canvas:publish:views {--y|y : Skip question?} {--f|force : Overwrite existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Canvas view files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Gather arguments...
        $publish = $this->option('y') ?: false;
        $force = $this->option('force') ?: false;

        if (! $publish) {
            $publish = $this->confirm('Publish Canvas core view files?');
        }

        // Publish views...
        if ($publish) {
            $exitCode = Artisan::call('vendor:publish', [
                '--provider' => 'Canvas\CanvasServiceProvider',
                '--tag' => 'views',
                '--force' => $force,
            ]);
            $this->line('<info>[✔]</info> Success! Canvas core view files have been published.'.PHP_EOL);
        }
    }
}
