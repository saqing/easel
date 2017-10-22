<?php

namespace Canvas\Console\Commands;

use Canvas\Helpers\SetupHelper;
use Canvas\Extensions\ThemeManager;

class Theme extends CanvasCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canvas:theme {theme? : Theme to activate.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate theme and/or view theme information';

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

        $themeManager = new ThemeManager(resolve('app'), resolve('files'));
        $activeTheme = $themeManager->getTheme($themeManager->getActiveTheme()) ?: $themeManager->getDefaultTheme();
        $newThemeId = $this->argument('theme');

        if ($newThemeId) {
            if ($newTheme = $themeManager->getTheme($newThemeId)) {
                $themeManager->activateTheme($newThemeId);
                $activeTheme = $newTheme;
                $this->comment(PHP_EOL."<info>[✔]</info> Successfully activated theme {$newTheme->getName()}!");
            } else {
                $this->line(PHP_EOL."<error>[✘]</error> Could not activate theme ($newThemeId). Theme not found!");
            }
        }

        // Display results
        $this->line('');
        $headers = ['Active Theme', 'Version'];
        $data = [[$activeTheme->getName(), $activeTheme->getVersion()]];
        $this->table($headers, $data);
        $this->line(PHP_EOL.'For more information on theme development, please visit cnvs.readme.io/docs/theme-overview.'
            .PHP_EOL);
    }
}
