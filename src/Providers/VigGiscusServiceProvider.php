<?php

namespace VigStudio\VigGiscus\Providers;

use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\PanelSections\SettingOthersPanelSection;

class VigGiscusServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/vig-giscus')
            ->loadHelpers()
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews();

        PanelSectionManager::default()->beforeRendering(function () {
            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('vig-giscum')
                    ->setTitle('Vig Giscum Setting')
                    ->withDescription('Setting Giscum Comment')
                    ->withIcon('ti ti-message-cog')
                    ->withPriority(0)
                    ->withRoute('vig-giscus.settings')
            );
        });

        $this->app->booted(function () {
            add_filter(BASE_FILTER_PUBLIC_COMMENT_AREA, function (string $html) {
                $asys = setting('vig_giscum_lazyLoad', 1) ? 'async' : '';
                $position = setting('vig_giscum_inputPosition', 0) ? 'top' : 'bottom';

                return '<script src="https://giscus.app/client.js"
                        data-repo="' . setting('vig_giscum_repository', '') . '"
                        data-repo-id="' . setting('vig_giscum_repository_id', '') . '"
                        data-category="' . setting('vig_giscum_category', null) . '"
                        data-category-id="' . setting('vig_giscum_category_id', '') . '"
                        data-mapping="' . setting('vig_giscum_mapping', 'url') . '"
                        data-strict="' . setting('vig_giscum_strict', 0) . '"
                        data-reactions-enabled="' . setting('vig_giscum_reactionsEnabled', 1) . '"
                        data-emit-metadata="' . setting('vig_giscum_emitMetadata', 0) . '"
                        data-input-position="' . $position . '"
                        data-theme="' . setting('vig_giscum_theme', 'preferred_color_scheme') . '"
                        data-lang="' . setting('vig_giscum_lang', 'en') . '"
                        crossorigin="anonymous"
                        ' . $asys . '
                        ></script>';
            }, 1, 2);
        });

    }
}
