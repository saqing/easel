<?php

namespace Canvas\Console\Commands;

use Artisan;
use Canvas\Helpers\SetupHelper;

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
    protected $description = 'Upgrade Canvas to latest version';

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
        if (! SetupHelper::isInstalled()) {
            $this->line(PHP_EOL.'<error>[✘]</error> Canvas has not been installed yet.');
            $this->line(PHP_EOL.'For installation instructions, please visit cnvs.readme.io.'.PHP_EOL);
            die();
        }

        // Start the timer
        $time_start = microtime(true);

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
        $this->comment('Disabling maintenance mode...'.PHP_EOL);
        Artisan::call('up');

        // Grab new version...
        $newVersion = $this->canvasVersion();

        // Stop the timer
        $time_end = microtime(true);
        $result = $time_end - $time_start;

        // Display results...
        $headers = ['Previous Version', 'New Version'];
        $data = [[$oldVersion, $newVersion]];
        $this->table($headers, $data);

        $this->line(PHP_EOL.'<info>[✔]</info> The update completed in '.round($result, 2).' '.str_plural('second').'.'.PHP_EOL);

        $this->line('To see what\'s new, please visit https://cnvs.readme.io/docs/changelog.'.PHP_EOL);
    }
}
