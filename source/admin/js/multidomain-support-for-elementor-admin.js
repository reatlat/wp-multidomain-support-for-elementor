'use strict';

(function ($) {

    class EMS {

        constructor({
                        debug = false,
                        default_lang = 'en',
                        current_lang = 'en',
                        domains = window.location.host,
                        urls = window.location.origin,
                        wpml_plugin_name = 'not-founded',
                        admin_url = window.location.origin + '/wp-admin/'
                    }) {
            this.debug = debug;
            this.default_lang = default_lang;
            this.current_lang = current_lang;
            this.domains = domains;
            this.urls = urls;
            this.wpml_plugin_name = wpml_plugin_name;
            this.admin_url = admin_url;
        }


        /**
         * Initial base scripts
         */
        _init() {
            this._debugLog('_init() =>', this);
            this._initTriggers();
            this._updateLangSwitcher(this);
        }


        /**
         * Debug console output, and show hidden params
         *
         * @param args
         */
        _debugLog(...args) {
            if (this.debug) {
                console.log('🦄 EMS:', ...args);
            }
        }


        /**
         * Initial triggers
         */
        _initTriggers() {
            this._debugLog('_initTriggers()');
        }


        /**
         * Update LangSwitcher
         * @param self
         * @private
         */
        _updateLangSwitcher(self) {
            switch (self.wpml_plugin_name) {
                case 'polylang':
                    $('#wp-admin-bar-languages a.ab-item').each(function (k, v) {
                        let url = self.urls[self.default_lang] + $(v).attr('href');
                        let lang_key = window.EMS._GET('lang', url);
                        // window.EMS._debugLog('edit link', lang_key, url);
                        url = new URL(url);
                        url.hostname = (lang_key === 'all') ? self.domains[self.default_lang] : self.domains[lang_key];
                        $(v).attr('href', url);
                    });
                    $("[class^='language_'] a, [class*=' language_'] a").each(function (k, v) {
                        let url = $(v).attr('href');
                        let lang_key = window.EMS._GET('new_lang', url);
                        window.EMS._debugLog('edit link', lang_key, url);
                        // TODO creat ajax or use rest api for get post locale
                        if (lang_key != null) {
                            url = new URL(url);
                            url.hostname = (lang_key === 'all') ? self.domains[self.default_lang] : self.domains[lang_key];
                            $(v).attr('href', url);
                        }
                    });
                    break;

                case 'wpml':
                    $('#wp-admin-bar-WPML_ALS-default li a.ab-item').each(function (k, v) {
                        let url = $(v).attr('href');
                        let lang_key = window.EMS._GET('lang', url);
                        window.EMS._debugLog('edit link', lang_key, url);
                        url = new URL(url);
                        url.hostname = (lang_key === 'all') ? self.domains[self.default_lang] : self.domains[lang_key];
                        $(v).attr('href', url);
                    });
                    $('.icl_translations.column-icl_translations a').each(function (k, v) {
                        let url = self.admin_url + $(v).attr('href');
                        let lang_key = window.EMS._GET('lang', url);
                        // window.EMS._debugLog('edit link', lang_key, url);
                        url = new URL(url);
                        url.hostname = self.domains[lang_key];
                        $(v).attr('href', url);
                    });
                    break;

                default:
                    window.EMS._debugLog('Welcome to the Jungle!');
                    break;
            }
        }


        /**
         * GET requests from links
         *
         * @param {string} param
         * @param {string} url
         * @returns {*}
         */
        _GET(param, url) {
            url = url ? url : window.location.href;
            this._debugLog('_GET() => ', param, url);
            let vars = {};
            url.replace(location.hash, '').replace(/[?&]+([^=&]+)=?([^&]*)?/gi, function (m, key, value) {
                vars[key] = value !== void 0 ? value : '';
            });
            if (param) {
                if (vars[param]) {
                    return vars[param];
                } else {
                    return null;
                }
            }
            return vars;
        };

    }

    window.EMS = new EMS(ELEMENTOR_MULTIDOMAIN_SUPPORT_CONFIG);

    window.EMS._init();

})(jQuery);
