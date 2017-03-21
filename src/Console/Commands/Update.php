<?php

namespace Canvas\Console\Commands;

use Artisan;

class Update extends CanvasCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canvas:update {--views : Also publish Canvas views.} {--f|force : Overwrite existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Canvas update wizard';

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
        // Gather the options...
        $force = $this->option('force') ?: false;
        $withViews = $this->option('views') ?: false;
        $update = true;
        $currentVersion = $oldVersion = $this->canvasVersion();

        // Enable maintenance mode...
        $this->comment(PHP_EOL.'Enabling maintenance mode...');
        Artisan::call('down');

        // Update dependencies...
        $this->comment('Composer update...');
        $updateCore = shell_exec('cd '.base_path().'; composer update --quiet');

        // Update core assets...
        if ($update) {
            $this->comment('Publishing core package assets...');

            // Don't link storage - assume storage is already linked
            // Don't publish config files - assume config has been set at install and modified afterwards

            // Publish public assets...
            Artisan::call('canvas:publish:assets', [
                '--y' => true,
                // Always update public assets...
                '--force' => true,
            ]);
            // Publish view files...
            if ($withViews) {
                Artisan::call('canvas:publish:views', [
                    '--y' => true,
                    // User can decide this...
                    '--force' => $force,
                ]);
            }
        }

        $this->rebuildSearchIndexes();

        $this->comment('Finishing up the upgrade process...');

        // Clear the caches...
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        // Disable maintenance mode...
        $this->comment('Disabling maintenance mode...');
        Artisan::call('up');

        // Grab new version...
        $newVersion = $this->canvasVersion();
        $this->line(PHP_EOL.'<info>[✔]</info> Your installation of Canvas has been updated.'.PHP_EOL);

        // Display results...
        $headers = ['Previous Version', 'New Version'];
        $data = [[$oldVersion, $newVersion]];
        $this->table($headers, $data);

        $this->line(PHP_EOL.'To view all the upgrade changes, please visit github.com/cnvs/easel/releases.'
            .PHP_EOL);
    }
}
