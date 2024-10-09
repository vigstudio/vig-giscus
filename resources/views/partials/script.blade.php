<script
    src="https://giscus.app/client.js"
    data-repo="{{ setting('vig_giscum_repository', '') }}"
    data-repo-id="{{ setting('vig_giscum_repository_id', '') }}"
    data-category="{{ setting('vig_giscum_category', null) }}"
    data-category-id="{{ setting('vig_giscum_category_id', '') }}"
    data-mapping="{{ setting('vig_giscum_mapping', 'url') }}"
    data-strict="{{ setting('vig_giscum_strict', false) }}"
    data-reactions-enabled="{{ setting('vig_giscum_reactionsEnabled', true) }}"
    data-emit-metadata="{{ setting('vig_giscum_emitMetadata', false) }}"
    data-input-position="{{ setting('vig_giscum_inputPosition', false) ? 'top' : 'bottom' }}"
    data-theme="{{ setting('vig_giscum_theme', 'preferred_color_scheme') }}"
    data-lang="{{ setting('vig_giscum_lang', 'en') }}"
    crossorigin="anonymous"
    {{ setting('vig_giscum_lazyLoad', true) ? 'async' : '' }}
></script>
