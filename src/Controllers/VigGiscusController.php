<?php

namespace VigStudio\VigGiscus\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Setting\Http\Controllers\SettingController;
use Http;
use Illuminate\Http\Request;
use VigStudio\VigGiscus\Forms\Setting;
use VigStudio\VigGiscus\Requests\SettingRequest;

class VigGiscusController extends SettingController
{
    public function edit()
    {
        $this->pageTitle('Vig Gitcus Setting');
        Assets::addScriptsDirectly('vendor/core/plugins/vig-giscus/vig-giscum-setting.js');

        return Setting::create()->renderForm();
    }

    public function update(SettingRequest $request)
    {
        return $this->performUpdate($request->all());
    }

    public function getData(Request $request)
    {
        $name = $request->name;
        $data = Http::get('https://giscus.app/api/discussions/categories?repo=' . $name)->json();

        return response()->json($data, 200);
    }
}
