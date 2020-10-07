{extends file="$layouts_admin"}

{block name="content"}

    <div class="row">
        <div class="col-md-6">
            <div class="panel" id="ui_settings">
                <div class="panel-hdr">
                    <h2>{$_L['User Interface']}</h2>


                </div>
                <div class="panel-container">
                    <div class="panel-content">

                        <div class="settings-panel">
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        {$_L['App Layout']}

                                    </h5>
                                </div>
                            </div>

{*                            <div class="d-flex justify-content-between">*}
{*                                <div>*}
{*                                    <div class="list">*}
{*                                        <strong>Fixed Header</strong>*}
{*                                        <p>header is in a fixed at all times</p>*}
{*                                    </div>*}
{*                                </div>*}
{*                                <div>*}
{*                                    <label class="switch s-icons s-outline s-outline-primary">*}
{*                                        <input type="checkbox" id="config_invoicing" {if get_option('invoicing') eq '1'}checked{/if}>*}
{*                                        <span class="slider round"></span>*}
{*                                    </label>*}
{*                                </div>*}
{*                            </div>*}

                            <div class="list" id="fh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                                <span class="onoffswitch-title"> {$_L['Fixed Header']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['header is in a fixed at all times']}</span>
                            </div>
                            <div class="list" id="nff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                                <span class="onoffswitch-title"> {$_L['Fixed Navigation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['left panel is fixed']}</span>
                            </div>
                            <div class="list" id="nfm">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                                <span class="onoffswitch-title"> {$_L['Minify Navigation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['skew nav to maximize space']}</span>
                            </div>
                            <div class="list" id="nfh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                                <span class="onoffswitch-title"> {$_L['Hide Navigation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['roll mouse on edge to reveal']}</span>
                            </div>
                            <div class="list" id="nft">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                                <span class="onoffswitch-title"> {$_L['Top Navigation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['relocate left pane to top']}</span>
                            </div>
                            <div class="list" id="fff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="footer-function-fixed"></a>
                                <span class="onoffswitch-title"> {$_L['Fixed Footer']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['page footer is fixed']}</span>
                            </div>
                            <div class="list" id="mmb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                                <span class="onoffswitch-title"> {$_L['Boxed Layout']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['encapsulates to a container']}</span>
                            </div>
                            <div class="expanded">
                                <ul class="mb-3 mt-1">
                                    <li>
                                        <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                    </li>
                                    <li>
                                        <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                    </li>
                                    <li>
                                        <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                    </li>
                                    <li>
                                        <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                    </li>
                                    <li>
                                        <div class="bg-white border" data-action="toggle" data-class="mod-bg-none"></div>
                                    </li>
                                </ul>
                                <div class="list" id="mbgf">
                                    <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                                    <span class="onoffswitch-title"> {$_L['Fixed Background']}</span>
                                </div>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        {$_L['Mobile Menu']}

                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="nmp">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
                                <span class="onoffswitch-title"> {$_L['Push Content']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['content pushed on menu reveal']}</span>
                            </div>
                            <div class="list" id="nmno">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
                                <span class="onoffswitch-title"> {$_L['No Overlay']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['removes mesh on menu reveal']}</span>
                            </div>
                            <div class="list" id="sldo">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
                                <span class="onoffswitch-title"> {$_L['Off-Canvas']} <sup>{$_L['beta']}</sup></span>
                                <span class="onoffswitch-title-desc"> {$_L['content overlaps menu']}</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        {$_L['Accessibility']}

                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mbf">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                                <span class="onoffswitch-title"> {$_L['Bigger Content Font']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['content fonts are bigger for readability']}</span>
                            </div>
                            <div class="list" id="mhc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                                <span class="onoffswitch-title"> {$_L['High Contrast Text (WCAG 2 AA)']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['4.5:1 text contrast ratio']}</span>
                            </div>
                            <div class="list" id="mcb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                                <span class="onoffswitch-title"> {$_L['Daltonism']} <sup> {$_L['beta']}</sup> </span>
                                <span class="onoffswitch-title-desc"> {$_L['color vision deficiency']}</span>
                            </div>
                            <div class="list" id="mpc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                                <span class="onoffswitch-title"> {$_L['Preloader Inside']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['preloader will be inside content']}</span>
                            </div>
                            <div class="list" id="mpi">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-panel-icon"></a>
                                <span class="onoffswitch-title"> {$_L['SmartPanel Icons']}{$_L['not Panels']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['smartpanel buttons will appear as icons']}</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        {$_L['Global Modifications']}

                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mcbg">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                                <span class="onoffswitch-title"> {$_L['Clean Page Background']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['adds more whitespace']}</span>
                            </div>
                            <div class="list" id="mhni">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                                <span class="onoffswitch-title"> {$_L['Hide Navigation Icons']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['invisible navigation icons']}</span>
                            </div>
                            <div class="list" id="dan">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                                <span class="onoffswitch-title"> {$_L['Disable CSS Animation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['disables css based animations']}</span>
                            </div>
                            <div class="list" id="mhic">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                                <span class="onoffswitch-title"> {$_L['Hide Info Card']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['hides info card from left panel']}</span>
                            </div>
                            <div class="list" id="mlph">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                                <span class="onoffswitch-title"> {$_L['Lean Subheader']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['distinguished page header']}</span>
                            </div>
                            <div class="list" id="mnl">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                                <span class="onoffswitch-title"> {$_L['Hierarchical Navigation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['clear breakdown of nav links']}</span>
                            </div>
                            <div class="list" id="mdn">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-dark"></a>
                                <span class="onoffswitch-title"> {$_L['Dark Navigation']}</span>
                                <span class="onoffswitch-title-desc"> {$_L['navigation background is darkend']}</span>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        {$_L['Global Font Size']}

                                    </h5>
                                </div>
                            </div>
                            <div class="list mt-1">
                                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                    <label class="btn btn-default btn-sm {if isset($config['font_size']) && $config['font_size'] == 'roo-text-sm'}active{/if}" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                                        <input type="radio" {if isset($config['font_size']) && $config['font_size'] == 'roo-text-sm'}checked{/if} name="changeFrontSize"> SM
                                    </label>
                                    <label class="btn btn-default btn-sm {if empty($config['font_size']) || $config['font_size'] == 'roo-text'}active{/if}" data-action="toggle-swap" data-class="root-text" data-target="html">
                                        <input type="radio" name="changeFrontSize" {if empty($config['font_size']) || $config['font_size'] == 'roo-text'}checked{/if}> MD
                                    </label>
                                    <label class="btn btn-default btn-sm {if isset($config['font_size']) && $config['font_size'] == 'roo-text-md'}active{/if}" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                                        <input type="radio" {if isset($config['font_size']) && $config['font_size'] == 'roo-text-lg'}checked{/if} name="changeFrontSize"> LG
                                    </label>
                                    <label class="btn btn-default btn-sm {if isset($config['font_size']) && $config['font_size'] == 'roo-text-xl'}active{/if}" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                                        <input type="radio" {if isset($config['font_size']) && $config['font_size'] == 'roo-text-xl'}checked{/if} name="changeFrontSize"> XL
                                    </label>
                                </div>
                                <span class="onoffswitch-title-desc d-block mb-0">
                                     {$_L['change root font size to effect rem values (resets on page refresh)']}
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0 pr-2 d-flex">
                                        {$_L['Theme colors']}

                                    </h5>
                                </div>
                            </div>
                            <div class="expanded theme-colors pl-5 pr-3">
                                <ul class="m-0">
{*                                    <li>*}
{*                                        <a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="theme-1" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="theme-2" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="theme-3" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="theme-4" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="theme-5" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="theme-6" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="theme-7" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="theme-8" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="theme-9" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="theme-10" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="theme-11" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="theme-12" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="theme-13" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-14" data-action="theme-update" data-themesave data-theme="theme-14" data-toggle="tooltip" data-placement="top" title="Supernova" data-original-title="Supernova"></a>*}
{*                                    </li>*}
{*                                    <li>*}
{*                                        <a href="#" id="myapp-15" data-action="theme-update" data-themesave data-theme="theme-15" data-toggle="tooltip" data-placement="top" title="Hoki" data-original-title="Hoki"></a>*}
{*                                    </li>*}

                                    <li>
                                        <a href="#" id="clx-theme-light-blue" data-action="theme-update" data-themesave data-theme="light_blue" data-toggle="tooltip" data-placement="top" title="Light Blue" data-original-title="Light Blue"></a>
                                    </li>

                                    <li>
                                        <a href="#" id="clx-theme-indigo-blue" data-action="theme-update" data-themesave data-theme="indigo_blue" data-toggle="tooltip" data-placement="top" title="Indigo Blue" data-original-title="Indigo Blue"></a>
                                    </li>

                                    <li>
                                        <a href="#" id="clx-theme-blue-extra" data-action="theme-update" data-themesave data-theme="blue_extra" data-toggle="tooltip" data-placement="top" title="Blue Extra" data-original-title="Blue Extra"></a>
                                    </li>

                                    <li>
                                        <a href="#" id="clx-theme-purple" data-action="theme-update" data-themesave data-theme="purple" data-toggle="tooltip" data-placement="top" title="Purple" data-original-title="Purple"></a>
                                    </li>


                                    <li>
                                        <a href="#" id="clx-theme-dark" data-action="theme-update" data-themesave data-theme="dark" data-toggle="tooltip" data-placement="top" title="Dark SF" data-original-title="Dark SF"></a>
                                    </li>

{*                                    <li>*}
{*                                        <a href="#" id="clx-theme-dark-mode" data-action="theme-update" data-themesave data-theme="dark_mode" data-toggle="tooltip" data-placement="top" title="Dark Mode" data-original-title="Dark Mode"></a>*}
{*                                    </li>*}

                                    <li>
                                        <a href="#" id="clx-theme-light-mode" data-action="theme-update" data-themesave data-theme="light_mode" data-toggle="tooltip" data-placement="top" title="Light Mode" data-original-title="Light Mode"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-california" data-action="theme-update" data-themesave data-theme="california" data-toggle="tooltip" data-placement="top" title="California" data-original-title="California"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-nordic" data-action="theme-update" data-themesave data-theme="nordic" data-toggle="tooltip" data-placement="top" title="Nordic" data-original-title="Nordic"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-tokyo" data-action="theme-update" data-themesave data-theme="tokyo" data-toggle="tooltip" data-placement="top" title="Tokyo" data-original-title="Tokyo"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-sydney" data-action="theme-update" data-themesave data-theme="sydney" data-toggle="tooltip" data-placement="top" title="Sydney" data-original-title="Sydney"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-brazil" data-action="theme-update" data-themesave data-theme="brazil" data-toggle="tooltip" data-placement="top" title="Brazil" data-original-title="Brazil"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-mumbai" data-action="theme-update" data-themesave data-theme="mumbai" data-toggle="tooltip" data-placement="top" title="Mumbai" data-original-title="Mumbai"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-istanbul" data-action="theme-update" data-themesave data-theme="istanbul" data-toggle="tooltip" data-placement="top" title="Istanbul" data-original-title="Istanbul"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-vancouver" data-action="theme-update" data-themesave data-theme="vancouver" data-toggle="tooltip" data-placement="top" title="Vancouver" data-original-title="Vancouver"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-singapore" data-action="theme-update" data-themesave data-theme="singapore" data-toggle="tooltip" data-placement="top" title="Singapore" data-original-title="Singapore"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-bali" data-action="theme-update" data-themesave data-theme="bali" data-toggle="tooltip" data-placement="top" title="Bali" data-original-title="Bali"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-barcelona" data-action="theme-update" data-themesave data-theme="barcelona" data-toggle="tooltip" data-placement="top" title="Barcelona" data-original-title="Barcelona"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-london" data-action="theme-update" data-themesave data-theme="london" data-toggle="tooltip" data-placement="top" title="London" data-original-title="London"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="clx-theme-dubai" data-action="theme-update" data-themesave data-theme="dubai" data-toggle="tooltip" data-placement="top" title="Dubai" data-original-title="Dubai"></a>
                                    </li>

                                </ul>
                            </div>
                            <hr class="mb-0 mt-4">
{*                            <div class="mt-4 d-table w-100 pl-5 pr-3">*}
{*                                <div class="d-table-cell align-middle">*}
{*                                    <h5 class="p-0 pr-2 d-flex">*}
{*                                        Theme Modes (beta)*}
{*                                        <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus" data-placement="top" title="" data-html="true" data-content="This is a brand new technique we are introducing which uses CSS variables to infiltrate color options. While this has been working nicely on modern browsers without much issues, some users <strong>may still face issues on Internet Explorer </strong>. Until these issues are resolved or Internet Explorer improves, this feature will remain in Beta" data-original-title="<span class='text-primary'><i class='fal fa-question-circle mr-1'></i> Why beta?</span>" data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i class="fal fa-question-circle mr-1"></i> why beta?</a>*}
{*                                    </h5>*}
{*                                </div>*}
{*                            </div>*}
{*                            <div class="pl-5 pr-3 py-3">*}
{*                                <div class="ie-only alert alert-warning d-none">*}
{*                                    <h6>Internet Explorer Issue</h6>*}
{*                                    This particular component may not work as expected in Internet Explorer. Please use with caution.*}
{*                                </div>*}
{*                                <div class="row no-gutters">*}
{*                                    <div class="col-4 pr-2 text-center">*}
{*                                        <div id="skin-default" data-action="toggle-replace" data-replaceclass="mod-skin-light mod-skin-dark" data-class="" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-primary rounded overflow-hidden text-success js-waves-on" data-original-title="Default Mode" style="height: 80px">*}
{*                                            <div class="bg-primary-600 bg-primary-gradient px-2 pt-0 border-right border-primary"></div>*}
{*                                            <div class="d-flex flex-column flex-1">*}
{*                                                <div class="bg-white border-bottom border-primary py-1"></div>*}
{*                                                <div class="bg-faded flex-1 pt-3 pb-3 px-2">*}
{*                                                    <div class="py-3" style="background:url('img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        Default*}
{*                                    </div>*}
{*                                    <div class="col-4 px-1 text-center">*}
{*                                        <div id="skin-light" data-action="toggle-replace" data-replaceclass="mod-skin-dark" data-class="mod-skin-light" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-secondary rounded overflow-hidden text-success js-waves-on" data-original-title="Light Mode" style="height: 80px">*}
{*                                            <div class="bg-white px-2 pt-0 border-right border-"></div>*}
{*                                            <div class="d-flex flex-column flex-1">*}
{*                                                <div class="bg-white border-bottom border- py-1"></div>*}
{*                                                <div class="bg-white flex-1 pt-3 pb-3 px-2">*}
{*                                                    <div class="py-3" style="background:url('img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        Light*}
{*                                    </div>*}
{*                                    <div class="col-4 pl-2 text-center">*}
{*                                        <div id="skin-dark" data-action="toggle-replace" data-replaceclass="mod-skin-light" data-class="mod-skin-dark" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-dark rounded overflow-hidden text-success js-waves-on" data-original-title="Dark Mode" style="height: 80px">*}
{*                                            <div class="bg-fusion-500 px-2 pt-0 border-right"></div>*}
{*                                            <div class="d-flex flex-column flex-1">*}
{*                                                <div class="bg-fusion-600 border-bottom py-1"></div>*}
{*                                                <div class="bg-fusion-300 flex-1 pt-3 pb-3 px-2">*}
{*                                                    <div class="py-3 opacity-30" style="background:url('img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        Dark*}
{*                                    </div>*}
{*                                </div>*}
{*                            </div>*}
{*                            <hr class="mb-0 mt-4">*}
{*                            <div class="pl-5 pr-3 py-3 bg-faded">*}
{*                                <div class="row no-gutters">*}
{*                                    <div class="col-6 pr-1">*}
{*                                        <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>*}
{*                                    </div>*}
{*                                    <div class="col-6 pl-1">*}
{*                                        <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>*}
{*                                    </div>*}
{*                                </div>*}
{*                            </div>*}
                        </div>

                        <table class="table table-hover">
                            <tbody>



                            <tr>
                                <td width="80%"><label for="config_rtl">{$_L['Enable RTL']} </label></td>
                                <td><input type="checkbox" {if get_option('rtl') eq '1'}checked{/if} data-toggle="toggle"
                                           data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_rtl"></td>
                            </tr>


                            <tr>
                                <td width="80%"><label for="config_mininav">{$_L['Fold Sidebar Default']} </label></td>
                                <td><input type="checkbox" {if get_option('mininav') eq '1'}checked{/if} data-toggle="toggle"
                                           data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_mininav">
                                </td>
                            </tr>

                            <tr>
                                <td width="80%"><label for="config_hide_footer">{$_L['Hide Footer Copyright']} </label></td>
                                <td><input type="checkbox" {if get_option('hide_footer') eq '1'}checked{/if}
                                           data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}"
                                           id="config_hide_footer"></td>
                            </tr>
                            <tr>
                                <td width="80%"><label for="config_hide_cover_image">{$_L['Hide Cover Image']} </label></td>
                                <td><input type="checkbox" {if get_option('hide_cover_image') eq '1'}checked{/if}
                                           data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}"
                                           id="config_hide_cover_image"></td>
                            </tr>

                            <tr>
                                <td width="80%"><label for="config_show_sidebar_header">{$_L['Show sidebar header']} </label></td>
                                <td><input type="checkbox" {if get_option('show_sidebar_header') eq '1'}checked{/if}
                                           data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}"
                                           id="config_show_sidebar_header"></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>


                    <hr>



<div class="panel-container">
    <div class="panel-content">
        <div class="form-group">
            <label for="contentAnimation">{$_L['Content Animation']}</label>
            <select name="contentAnimation" id="contentAnimation" class="form-control">

                <option value="" {if $config['contentAnimation'] eq ''}selected{/if}>{$_L['None']}</option>

                {$ca_options}

            </select>
        </div>
        <div class="form-group">
            <label for="contact_set_view_mode">{$_L['Customers View Mode']}</label>
            <select name="contact_set_view_mode" id="contact_set_view_mode" class="form-control">

                <option value="tbl" {if $config['contact_set_view_mode'] eq 'tbl'}selected{/if}>{$_L['Table']}</option>
                <option value="card" {if $config['contact_set_view_mode'] eq 'card'}selected{/if}>{$_L['Card']}</option>
                <option value="search" {if $config['contact_set_view_mode'] eq 'search'}selected{/if}>{$_L['Search']}</option>



            </select>
        </div>
    </div>
</div>




                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="panel" id="ui_dashboard_settings">
                <div class="panel-hdr">
                    <h2>{$_L['Dashboard Widgets']}</h2>


                </div>
                <div class="panel-container">
                    <div class="panel-content">
                        <table class="table table-hover">
                            <tbody>

                            <tr>
                                <td width="80%"><label for="config_dashboard_widgets_tickets">{$_L['Tickets']} </label></td>
                                <td><input type="checkbox" {if isset($config['dashboard_widgets_tickets']) && $config['dashboard_widgets_tickets'] == 1}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_dashboard_widgets_tickets"></td>
                            </tr>


                            <tr>
                                <td width="80%"><label for="config_dashboard_widgets_tasks">{$_L['Tasks']} </label></td>
                                <td><input type="checkbox" {if isset($config['dashboard_widgets_tasks']) && $config['dashboard_widgets_tasks'] == 1}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_dashboard_widgets_tasks"></td>
                            </tr>




                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="refresh_widget_every">{$_L['Refresh Widget Every']}</label>
                            <select name="refresh_widget_every" id="refresh_widget_every" class="form-control">




                                <option value="60000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '60000'}selected{/if}>1 {$_L['minute']}</option>
                                <option value="120000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '120000'}selected{/if}>2 {$_L['minutes']}</option>
                                <option value="180000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '180000'}selected{/if}>3 {$_L['minutes']}</option>
                                <option value="240000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '240000'}selected{/if}>4 {$_L['minutes']}</option>
                                <option value="300000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '300000'}selected{/if}>5 {$_L['minutes']}</option>
                                <option value="360000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '360000'}selected{/if}>6 {$_L['minutes']}</option>
                                <option value="420000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '420000'}selected{/if}>7 {$_L['minutes']}</option>
                                <option value="480000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '480000'}selected{/if}>8 {$_L['minutes']}</option>
                                <option value="540000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '540000'}selected{/if}>9 {$_L['minutes']}</option>
                                <option value="600000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '600000'}selected{/if}>10 {$_L['minutes']}</option>
                                <option value="660000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '660000'}selected{/if}>11 {$_L['minutes']}</option>
                                <option value="720000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '720000'}selected{/if}>12 {$_L['minutes']}</option>
                                <option value="780000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '780000'}selected{/if}>13 {$_L['minutes']}</option>
                                <option value="840000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '840000'}selected{/if}>14 {$_L['minutes']}</option>
                                <option value="900000" {if isset($config['refresh_widget_every']) && $config['refresh_widget_every'] eq '900000'}selected{/if}>15 {$_L['minutes']}</option>

                            </select>


                        </div>
                    </div>






                </div>
            </div>
        </div>

    </div>
{/block}

{block name="script"}
    <script>
        $(document).ready(function () {



            var _url = $("#_url").val();







            $('#config_rtl').change(function() {

                $('#ui_settings').block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "rtl", val: "1" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "rtl", val: "0" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });
                }
            });

            $('#config_mininav').change(function() {

                $('#ui_settings').block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "mininav", val: "1" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "mininav", val: "0" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });
                }
            });

            $('#config_hide_footer').change(function() {

                $('#ui_settings').block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "hide_footer", val: "1" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "hide_footer", val: "0" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });
                }
            });

            $('#config_show_sidebar_header').change(function() {

                $('#ui_settings').block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "show_sidebar_header", val: "1" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "show_sidebar_header", val: "0" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });
                }
            });


            $('#config_hide_cover_image').change(function() {

                $('#ui_settings').block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "hide_cover_image", val: "1" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "hide_cover_image", val: "0" })
                        .done(function( data ) {
                            $('#ui_settings').unblock();
                            location.reload();
                        });
                }
            });



            var $contentAnimation = $("#contentAnimation");


            $contentAnimation.change(function() {

                $('#ui_settings').block({ message: null });

                $.post( _url+'settings/update_option/', { opt: "contentAnimation", val: $contentAnimation.val() })
                    .done(function( data ) {
                        $('#ui_settings').unblock();
                        location.reload();
                    });


            });

            var $contact_set_view_mode = $("#contact_set_view_mode");

            $contact_set_view_mode.change(function() {

                window.location = base_url + 'contacts/set_view_mode/' + $contact_set_view_mode.val() + '/';


            });


            var $ui_dashboard_settings = $('#ui_dashboard_settings');

            $('#config_dashboard_widgets_tickets').change(function() {

                $ui_dashboard_settings.block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "dashboard_widgets_tickets", val: "1" })
                        .done(function( data ) {
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "dashboard_widgets_tickets", val: "0" })
                        .done(function( data ) {
                            location.reload();
                        });
                }
            });



            $('#config_dashboard_widgets_tasks').change(function() {

                $ui_dashboard_settings.block({ message: null });


                if($(this).prop('checked')){

                    $.post( _url+'settings/update_option/', { opt: "dashboard_widgets_tasks", val: "1" })
                        .done(function( data ) {
                            location.reload();
                        });

                }
                else{
                    $.post( _url+'settings/update_option/', { opt: "dashboard_widgets_tasks", val: "0" })
                        .done(function( data ) {
                            location.reload();
                        });
                }
            });


            $('#refresh_widget_every').change(function() {

                $ui_dashboard_settings.block({ message: null });

                $.post( _url+'settings/update_option/', { opt: "refresh_widget_every", val: $('#refresh_widget_every').val() })
                    .done(function( data ) {
                        location.reload();
                    });
            });



        });
    </script>
{/block}
