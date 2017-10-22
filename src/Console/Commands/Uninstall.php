<?php

namespace Canvas\Console\Commands;

use Schema;
use Artisan;
use Exception;
use Canvas\Helpers\SetupHelper;
use Canvas\Helpers\CanvasHelper;
use Illuminate\Support\Facades\DB;

class Uninstall extends CanvasCommand
{
    protected $tnt;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canvas:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall Canvas';

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

        $this->warn(PHP_EOL.'**************************************'.PHP_EOL.'*              Warning!              *'.PHP_EOL.'**************************************');
        if ($this->confirm('Are you sure you want to completely uninstall Canvas?')) {
            try {
                // Start the timer
                $time_start = microtime(true);

                $this->comment('Removing all Canvas database tables...');
                $this->dropDatabase();
                $this->comment('Removing the uploads directory...');
                $this->removeUploadsSymlink();
                $this->removeUploads(storage_path('app/public/'));
                $this->comment('Removing the search indexes...');
                $this->removeIndexes();
                $this->comment('Removing the installation file...');
                $this->removeInstalledFile();
                $this->comment('Finishing up the uninstall process...');
                $this->clearAllCaches();

                // Stop the timer
                $time_end = microtime(true);
                $result = $time_end - $time_start;

                $this->line(PHP_EOL.'<info>[✔]</info> The uninstall completed in '.round($result, 2).' '.str_plural('second').'.'.PHP_EOL);
            } catch (Exception $e) {
                $this->line(PHP_EOL.'<error>[✘]</error> '.$e->getMessage());
            }
        }
    }

    protected function dropDatabase()
    {
        Schema::dropIfExists(CanvasHelper::TABLES['post_tag']);
        Schema::dropIfExists(CanvasHelper::TABLES['posts']);
        Schema::dropIfExists(CanvasHelper::TABLES['settings']);
        Schema::dropIfExists(CanvasHelper::TABLES['tags']);
        Schema::dropIfExists(CanvasHelper::TABLES['users']);
        DB::table('migrations')->where('migration', 'like', '%canvas%')->delete();
    }

    protected function removeUploadsSymlink()
    {
        if (is_link(public_path('storage'))) {
            unlink(public_path('storage'));
        }
    }

    protected function removeUploads($directory)
    {
        if (is_dir($directory)) {
            $dir_handle = opendir($directory);
        }
        if (! $dir_handle) {
            return false;
        }
        while ($file = readdir($dir_handle)) {
            if ($file != '.' && $file != '..' && $file != '.gitignore') {
                if (! is_dir($directory.'/'.$file)) {
                    unlink($directory.'/'.$file);
                } else {
                    self::removeUploads($directory.'/'.$file);
                }
            }
        }
        closedir($dir_handle);

        return true;
    }

    protected function removeIndexes()
    {
        if (file_exists(storage_path(CanvasHelper::INDEXES['posts']))) {
            unlink(storage_path(CanvasHelper::INDEXES['posts']));
        }
        if (file_exists(storage_path(CanvasHelper::INDEXES['tags']))) {
            unlink(storage_path(CanvasHelper::INDEXES['tags']));
        }
        if (file_exists(storage_path(CanvasHelper::INDEXES['users']))) {
            unlink(storage_path(CanvasHelper::INDEXES['users']));
        }
    }

    protected function removeInstalledFile()
    {
        if (file_exists(storage_path(CanvasHelper::INSTALLED_FILE))) {
            unlink(storage_path(CanvasHelper::INSTALLED_FILE));
        }
    }

    protected function clearAllCaches()
    {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
    }
}
