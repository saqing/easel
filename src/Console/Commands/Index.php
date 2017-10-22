<?php

namespace Canvas\Console\Commands;

use Artisan;
use Exception;
use Canvas\Helpers\CanvasHelper;

class Index extends CanvasCommand
{
    protected $tnt;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canvas:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index content for searches';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            // Start the timer
            $time_start = microtime(true);

            $this->createPostsIndex();
            $this->createTagsIndex();
            $this->createUsersIndex();

            // Stop the timer
            $time_end = microtime(true);
            $result = $time_end - $time_start;
            $this->line(PHP_EOL.'<info>[✔]</info> The index completed in '.round($result, 2).' '.str_plural('second').'.'.PHP_EOL);
        } catch (Exception $e) {
            $this->line(PHP_EOL.'<error>[✘]</error> '.$e->getMessage().PHP_EOL);
        }
    }

    public function createPostsIndex()
    {
        $this->comment(PHP_EOL.'Indexing the posts table, saving to '.storage_path(CanvasHelper::INDEXES['posts']).'...');
        Artisan::call('scout:import', ['model' => 'Canvas\\Models\\Post']);
    }

    public function createTagsIndex()
    {
        $this->comment('Indexing the tags table, saving to '.storage_path(CanvasHelper::INDEXES['tags']).'...');
        Artisan::call('scout:import', ['model' => 'Canvas\\Models\\Tag']);
    }

    public function createUsersIndex()
    {
        $this->comment('Indexing the users table, saving to '.storage_path(CanvasHelper::INDEXES['users']).'...');
        Artisan::call('scout:import', ['model' => 'Canvas\\Models\\User']);
    }
}
