<?php

namespace VigStudio\VigGiscus\Requests;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class SettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'vig_giscum_repository' => ['required'],
            'vig_giscum_repository_id' => ['required'],
            'vig_giscum_category_id' => ['required'],
            'vig_giscum_category' => ['required'],
            'vig_giscum_strict' => [new OnOffRule()],
            'vig_giscum_reactionsEnabled' => [new OnOffRule()],
            'vig_giscum_emitMetadata' => [new OnOffRule()],
            'vig_giscum_inputPosition' => [new OnOffRule()],
            'vig_giscum_lazyLoad' => [new OnOffRule()],
        ];
    }
}
