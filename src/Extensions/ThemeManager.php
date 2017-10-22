<?php

namespace Canvas\Extensions;

use Canvas\Meta\Constants;
use Canvas\Models\Settings;
use Illuminate\Support\Collection;

class ThemeManager extends ExtensionManager
{
    /**
     * @constant(TYPES)
     */
    const TYPES = ['canvas-theme'];

    /**
     * @constant(TARGET_DIR)
     */
    const TARGET_DIR = 'vendor/canvas';

    /**
     * @constant(ACTIVE_KEY)
     */
    const ACTIVE_KEY = 'active_theme';

    /**
     * Publish a themes public assets. Themes MUST have public assets.
     * @param Theme $theme
     * @return bool
     */
    protected function publishThemePublic(Theme $theme)
    {
        $target = public_path(self::TARGET_DIR);
        // Merge/overwrite theme public files.
        return $this->filesystem->copyDirectory($theme->getPublicDirectory(), $target);
    }

    /**
     * Publish a themes views.
     * @param Theme $theme
     * @param bool $clean Views directory is cleaned to ensure no interference with none theme views.
     * @return bool
     */
    protected function publishThemeViews(Theme $theme, $clean = true)
    {
        $target = base_path('resources/views/'.self::TARGET_DIR);
        // Skip the ordeal if theme doesn't have views
        if (! $this->filesystem->exists($theme->getViewsDirectory())) {
            return true;
        }
        // Clean views directory.
        if ($clean) {
            $clean = $this->filesystem->deleteDirectory($target) || true;
        }
        // Publish theme views.
        $published = $this->filesystem->copyDirectory($theme->getViewsDirectory(), $target);

        return $published;
    }

    /**
     * Deactivate all themes. Set canvas to "unthemed" state.
     * @return bool
     */
    public function unTheme()
    {
        $publicTarget = public_path(self::TARGET_DIR);
        $publicSource = __DIR__.'/../../public';
        $viewsTarget = base_path('resources/views/'.self::TARGET_DIR);

        // Clean Views
        $clean = $this->filesystem->deleteDirectory($viewsTarget) || true;
        // Clean Public assets
        $clean = $clean && ($this->filesystem->cleanDirectory($publicTarget) || true);
        // Republish original/default public assets
        $unthemed = $clean && $this->filesystem->copyDirectory($publicSource, $publicTarget);

        // Actions to be taken after theme deactivation
        if ($unthemed) {
            // Update DB Setting
            Settings::updateOrCreate(['setting_name' => self::ACTIVE_KEY], ['setting_value' => 'default']);
        }

        return $unthemed;
    }

    /**
     * @return Collection
     */
    public function getThemes()
    {
        $activeTheme = $this->getActive();
        $themes = new Collection;

        $themeExtensions = $this->getExtensions(self::TYPES)->each(function ($extension, $key) use ($themes) {
            $theme = new Theme($extension->getPath(), $extension->getComposerJson());
            $themes->put($theme->getId(), $theme);
        });
        $themes->each(function ($theme, $key) use ($activeTheme) {
            $theme->setInstalled(true);
            $theme->setVersion($theme->__get('version'));
            if ($key == $activeTheme) {
                $theme->setEnabled(true);
            }
        });

        return $themes;
    }

    /**
     * Generate a default theme.
     */
    public function getDefaultTheme()
    {
        $theme = new Theme('/', [
            'name'    => 'cnvs/canvas-theme-default',
            'extra'   => [
                'canvas-theme' => [
                    'title' => $this->getDefaultThemeName(),
                ],
            ],
        ]);
        $theme->setVersion(Constants::DEFAULT_THEME_VERSION);

        return $theme;
    }

    /**
     * Get default Theme name.
     * @return string
     */
    public function getDefaultThemeName()
    {
        return Constants::DEFAULT_THEME_NAME;
    }

    /**
     * Loads an Theme with all information.
     *
     * @param string $name
     * @return Theme|null
     */
    public function getTheme($name)
    {
        if ($name == 'default') {
            return $this->getDefaultTheme();
        }

        return $this->getThemes()->get($name);
    }

    /**
     * The id's of the enabled extensions.
     *
     * @return array
     */
    public function getActive()
    {
        return $active = Settings::getByName(self::ACTIVE_KEY) ?: ($this->config->get(self::ACTIVE_KEY) ?: 'default');
    }

    public function getActiveTheme()
    {
        return $this->getActive();
    }

    /**
     * Assert/change active theme.
     *
     * @param array $enabled
     * @return bool
     */
    public function activateTheme($themeId)
    {
        // Reset to stable base.
        $this->untheme();

        // If default theme is set, we're done.
        if ($themeId == 'default') {
            return true;
        }

        // Current Theme
        $currentTheme = $this->getTheme($currentThemeId = $this->getActive());
        // Chosen Theme
        $theme = $this->getTheme($themeId);
        // If new theme is aleady active we can skip the DB update.
        if ($currentTheme->getId() != $themeId) {
            Settings::updateOrCreate(['setting_name' => self::ACTIVE_KEY], ['setting_value' => $themeId]);
        }

        // Merge assets
        $publicPublished = $this->publishThemePublic($theme);
        // Clear views and publish theme views
        $viewsPublished = $this->publishThemeViews($theme);
        // If theme parts weren't successfully published return false;
        if (! $publicPublished && $viewsPublished) {
            // Reset to stable unthemed.
            $this->unTheme();

            return false;
        }

        return true;
    }

    public function setActiveTheme($id)
    {
        return $this->activateTheme($id);
    }

    public function theme($id)
    {
        return $this->activateTheme($id);
    }

    /**
     * Deactivate current theme.
     */
    public function deactivateTheme($themeId = null)
    {
        return $this->untheme();
    }
}
