<?php

namespace VigStudio\VigGiscus\Forms;

use Botble\Base\Forms\FieldOptions\{
    HtmlFieldOption,
    OnOffFieldOption,
    SelectFieldOption,
    TextFieldOption
};
use Botble\Base\Forms\Fields\{
    HtmlField,
    OnOffCheckboxField,
    SelectField,
    TextField
};
use Botble\Setting\Forms\SettingForm;
use VigStudio\VigGiscus\Requests\SettingRequest;

class Setting extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
        ->setValidatorClass(SettingRequest::class)
            ->setSectionTitle('Vig Giscum Setting')
            ->setSectionDescription('Setting Giscum Comment')
            ->add(
                'helper_1',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('
                        <h4>Repository</h4>
                        <p>Choose the repository giscus will connect to. Make sure that:</p>
                        <ol>
                            <li>The <strong>repository is <a href="https://docs.github.com/en/github/administering-a-repository/managing-repository-settings/setting-repository-visibility#making-a-repository-public" target="_blank" rel="noreferrer noopener nofollow">public</a></strong>, otherwise visitors will not be able to view the discussion.</li>
                            <li>The <strong><a href="https://github.com/apps/giscus" target="_blank" rel="noreferrer noopener nofollow">giscus</a> app is installed</strong>, otherwise visitors will not be able to comment and react.</li>
                            <li>The <strong>Discussions feature is turned on</strong> by <a href="https://docs.github.com/en/github/administering-a-repository/managing-repository-settings/enabling-or-disabling-github-discussions-for-a-repository" target="_blank" rel="noreferrer noopener nofollow">enabling it for your repository</a>.</li>
                        </ol>
                    ')
            )
            ->add(
                'get_data_url',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('
                        <script>
                            window.vigrepo="' . route('vig-giscus.settings.repo') . '";
                            window.vigcategory = "' . setting('vig_giscum_category', null) . '"
                        </script>
                    ')
            )
            ->add(
                'vig_giscum_repository',
                TextField::class,
                TextFieldOption::make()
                    ->attributes([
                        'id' => 'vig_giscum_repository',
                    ])
                    ->label('Repository')
                    ->value(setting('vig_giscum_repository', ''))
            )
            ->add(
                'showID',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<span id="vig_giscum_repository_show"></span>')
            )
            ->add(
                'vig_giscum_repository_id',
                'hidden',
                TextFieldOption::make()
                    ->attributes([
                        'id' => 'vig_giscum_repository_id',
                    ])
                    ->value(setting('vig_giscum_repository_id', ''))
            )
            ->add(
                'vig_giscum_lang',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Language')
                    ->choices([
                        'ca' => 'Català',
                        'da' => 'Dansk',
                        'de' => 'Deutsch',
                        'ar' => 'العربية',
                        'en' => 'English',
                        'eo' => 'Esperanto',
                        'es' => 'Español',
                        'fa' => 'فارسی',
                        'fr' => 'Français',
                        'gr' => 'Ελληνικά',
                        'hbs' => 'Srpsko-Hrvatski',
                        'he' => 'עברית',
                        'hu' => 'Magyar',
                        'id' => 'Indonesia',
                        'it' => 'Italiano',
                        'ja' => '日本語',
                        'kh' => 'ភាសាខ្មែរ',
                        'ko' => '한국어',
                        'nl' => 'Nederlands',
                        'pl' => 'Polski',
                        'pt' => 'Português',
                        'ro' => 'Română',
                        'ru' => 'Русский',
                        'th' => 'ภาษาไทย',
                        'tr' => 'Türkçe',
                        'vi' => 'Việt Nam',
                        'uk' => 'Українська',
                        'uz' => "O'zbek",
                        'zh-CN' => '简体中文',
                        'zh-TW' => '繁體中文',
                    ])
                    ->selected(setting('vig_giscum_lang', 'en'))
                    ->searchable()
            )
            ->add(
                'vig_giscum_mapping',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Page ↔️ Discussions Mapping')
                    ->choices([
                        'pathname' => 'Discussion title contains page pathname',
                        'url' => 'Discussion title contains page URL',
                        'title' => 'Discussion title contains page <title>',
                        'og:title' => 'Discussion title contains page og:title',
                        'specific' => 'Discussion title contains a specific term',
                        'number' => 'Specific discussion number',
                    ])
                    ->selected(setting('vig_giscum_mapping', 'url'))
                    ->searchable()
            )
            ->add(
                'vig_giscum_strict',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label('Use strict title matching')
                    ->value(setting('vig_giscum_strict', 0))
            )
            ->add(
                'vig_giscum_category_id',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Discussion Category')
                    ->attributes([
                        'id' => 'vig_giscum_category_id',
                    ])
                    ->choices([
                        '' => '--',
                    ])
                    ->selected(setting('vig_giscum_category_id', null))
                    ->helperText('Choose the discussion category where new discussions will be created. It is recommended to use a category with the Announcements type so that new discussions can only be created by maintainers and giscus.')
            )
            ->add(
                'showIDCategory',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<span id="vig_giscum_category_show"></span>')
            )
            ->add(
                'vig_giscum_category',
                'hidden',
                TextFieldOption::make()
                    ->attributes([
                        'id' => 'vig_giscum_category',
                    ])
                    ->value(setting('vig_giscum_category', ''))
            )
            ->add(
                'helper_2',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('
                        <h4>Features</h4>
                        <p>Choose whether specific features should be enabled.</p>
                    ')
            )
            ->add(
                'vig_giscum_reactionsEnabled',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label('Enable reactions for the main post')
                    ->value(setting('vig_giscum_reactionsEnabled', 1))
                    ->helperText('The reactions for the discussion\'s main post will be shown before the comments.')
            )
            ->add(
                'vig_giscum_emitMetadata',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label('Emit discussion metadata')
                    ->value(setting('vig_giscum_emitMetadata', 0))
                    ->helperText('Discussion metadata will be sent periodically to the parent window (the embedding page). For demonstration, enable this option and open your browser\'s console on this page. See <a href="https://github.com/giscus/giscus/blob/main/ADVANCED-USAGE.md#imetadatamessage" target="_blank" rel="noreferrer noopener nofollow">the documentation</a> for more details.')
            )
            ->add(
                'vig_giscum_inputPosition',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label('Place the comment box above the comments')
                    ->value(setting('vig_giscum_inputPosition', 0))
                    ->helperText('The comment input box will be placed above the comments, so that users can leave a comment without scrolling to the bottom of the discussion.')
            )
            ->add(
                'vig_giscum_lazyLoad',
                OnOffCheckboxField::class,
                OnOffFieldOption::make()
                    ->label('Load the comments lazily')
                    ->value(setting('vig_giscum_lazyLoad', 1))
                    ->helperText('Loading of the comments will be deferred until the user scrolls near the comments container. This is done by adding loading="lazy" to the iframe element.')
            )
            ->add(
                'vig_giscum_theme',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Theme')
                    ->helperText('<p>Choose a theme that matches your website. Can\'t find one that does? <a href="https://github.com/giscus/giscus/blob/main/CONTRIBUTING.md#creating-new-themes" target="_blank" rel="noreferrer noopener nofollow">Contribute</a> a new theme.</p>')
                    ->choices([
                        'light' => 'GitHub Light',
                        'light_high_contrast' => 'GitHub Light High Contrast',
                        'light_protanopia' => 'GitHub Light Protanopia &amp; Deuteranopia',
                        'light_tritanopia' => 'GitHub Light Tritanopia',
                        'dark' => 'GitHub Dark',
                        'dark_high_contrast' => 'GitHub Dark High Contrast',
                        'dark_protanopia' => 'GitHub Dark Protanopia &amp; Deuteranopia',
                        'dark_tritanopia' => 'GitHub Dark Tritanopia',
                        'dark_dimmed' => 'GitHub Dark Dimmed',
                        'preferred_color_scheme' => 'Preferred color scheme',
                        'transparent_dark' => 'Transparent Dark',
                        'noborder_light' => 'NoBorder Light',
                        'noborder_dark' => 'NoBorder Dark',
                        'noborder_gray' => 'NoBorder Gray',
                        'cobalt' => 'RStudio Cobalt',
                        'purple_dark' => 'Purple Dark',
                        'custom' => 'Custom (experimental)',
                    ])
                    ->selected(setting('vig_giscum_theme', 'preferred_color_scheme'))
                    ->searchable()
            );
    }
}
