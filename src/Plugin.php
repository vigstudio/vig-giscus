<?php

namespace VigStudio\VigGiscus;

use Botble\Setting\Facades\Setting;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Setting::newQuery()->where('key', 'like', '%vig_giscum_%')->delete();
    }
}
