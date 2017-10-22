<?php

namespace Canvas\Console\Commands;

use Canvas\Helpers\SetupHelper;

class Version extends CanvasCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canvas:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currently installed version of Canvas';

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

        // Grab version info...
        $currentVersion = $oldVersion = $this->canvasVersion();
        $latestVersion = $this->latestVersion();

        // Display results
        $this->line('');
        $headers = ['Installed Version', 'Latest Version'];
        $data = [[$currentVersion, $latestVersion]];
        $this->table($headers, $data);
        $this->line(PHP_EOL.'For more information on upgrading Canvas, please visit cnvs.readme.io/docs/upgrade-guide.'
            .PHP_EOL);
    }
}
