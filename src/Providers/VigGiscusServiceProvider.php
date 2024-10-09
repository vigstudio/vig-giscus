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
            add_filter(BASE_FILTER_PUBLIC_COMMENT_AREA, function (?string $html = null) {
                return $html . view('plugins/vig-giscus::partials.script');
            }, 999);
        });
    }
}
