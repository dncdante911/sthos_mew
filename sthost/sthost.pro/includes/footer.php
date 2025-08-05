</main>
    
    <!-- Footer -->
    <footer class="footer bg-dark text-light">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <!-- О компании -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5 class="widget-title"><?php echo t('footer_about_title'); ?></h5>
                            <div class="footer-logo mb-3">
                                <img src="/assets/images/logos/logo-white.svg" alt="StormHosting UA" height="30">
                                <span class="brand-text">Storm<span class="text-primary">Hosting</span> UA</span>
                            </div>
                            <p class="widget-text"><?php echo t('footer_about_text'); ?></p>
                            <div class="social-links">
                                <a href="https://t.me/stormhosting_ua" target="_blank" rel="noopener" class="social-link telegram">
                                    <i class="bi bi-telegram"></i>
                                </a>
                                <a href="https://facebook.com/stormhosting.ua" target="_blank" rel="noopener" class="social-link facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/stormhosting_ua" target="_blank" rel="noopener" class="social-link twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://instagram.com/stormhosting.ua" target="_blank" rel="noopener" class="social-link instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Услуги -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5 class="widget-title"><?php echo t('footer_services_title'); ?></h5>
                            <ul class="footer-links">
                                <li><a href="/hosting/shared"><?php echo t('hosting_shared'); ?></a></li>
                                <li><a href="/hosting/cloud"><?php echo t('hosting_cloud'); ?></a></li>
                                <li><a href="/hosting/reseller"><?php echo t('hosting_reseller'); ?></a></li>
                                <li><a href="/vds/virtual"><?php echo t('vds_virtual'); ?></a></li>
                                <li><a href="/vds/dedicated"><?php echo t('vds_dedicated'); ?></a></li>
                                <li><a href="/domains/register"><?php echo t('domains_register'); ?></a></li>
                                <li><a href="/info/ssl">SSL <?php echo t('certificates'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Поддержка -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5 class="widget-title"><?php echo t('footer_support_title'); ?></h5>
                            <ul class="footer-links">
                                <li><a href="/info/faq"><?php echo t('info_faq'); ?></a></li>
                                <li><a href="/tools/site-check"><?php echo t('tools_site_check'); ?></a></li>
                                <li><a href="/tools/ip-check"><?php echo t('tools_ip_check'); ?></a></li>
                                <li><a href="/info/rules"><?php echo t('info_rules'); ?></a></li>
                                <li><a href="/info/legal"><?php echo t('info_legal'); ?></a></li>
                                <li><a href="/info/complaints"><?php echo t('info_complaints'); ?></a></li>
                                <li><a href="/info/quality"><?php echo t('info_quality'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Информация -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5 class="widget-title"><?php echo t('nav_info'); ?></h5>
                            <ul class="footer-links">
                                <li><a href="/info/about"><?php echo t('info_about'); ?></a></li>
                                <li><a href="/contacts"><?php echo t('nav_contacts'); ?></a></li>
                                <li><a href="/info/advertising"><?php echo t('info_advertising'); ?></a></li>
                                <li><a href="/sitemap.xml">Sitemap</a></li>
                                <li><a href="/rss.xml">RSS</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Контакты -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5 class="widget-title"><?php echo t('footer_contacts_title'); ?></h5>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span><?php echo t('ukraine'); ?>, <?php echo t('dnipro'); ?></span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    <a href="tel:+380XXXXXXXXX">+380 XX XXX XX XX</a>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telegram"></i>
                                    <a href="https://t.me/stormhosting_ua" target="_blank">@stormhosting_ua</a>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-clock"></i>
                                    <span><?php echo t('contacts_work_hours'); ?>: <?php echo t('contacts_24_7'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright mb-0">
                            &copy; <?php echo date('Y'); ?> StormHosting UA. <?php echo t('footer_copyright'); ?>.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-bottom-right">
                            <div class="payment-methods">
                                <img src="/assets/images/payment/visa.svg" alt="Visa" height="20">
                                <img src="/assets/images/payment/mastercard.svg" alt="Mastercard" height="20">
                                <img src="/assets/images/payment/liqpay.svg" alt="LiqPay" height="20">
                                <img src="/assets/images/payment/privat24.svg" alt="Privat24" height="20">
                            </div>
                            <div class="developed-by">
                                <small><?php echo t('footer_developed_by'); ?> <a href="https://stormhosting.ua" target="_blank">StormHosting UA</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="<?php echo t('back_to_top'); ?>">
        <i class="bi bi-arrow-up"></i>
    </button>
    
    <!-- Cookie Notice -->
    <div id="cookie-notice" class="cookie-notice" style="display: none;">
        <div class="container">
            <div class="cookie-content">
                <p><?php echo t('cookie_notice_text'); ?></p>
                <div class="cookie-buttons">
                    <button id="accept-cookies" class="btn btn-primary btn-sm"><?php echo t('cookie_accept'); ?></button>
                    <button id="decline-cookies" class="btn btn-outline-secondary btn-sm"><?php echo t('cookie_decline'); ?></button>
                    <a href="/info/privacy" class="btn btn-link btn-sm"><?php echo t('cookie_learn_more'); ?></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/main.js?v=<?php echo filemtime('assets/js/main.js'); ?>"></script>
    <script src="/assets/js/animations.js?v=<?php echo filemtime('assets/js/animations.js'); ?>"></script>
    
    <?php if (isset($page_js) && !empty($page_js)): ?>
        <script src="/assets/js/pages/<?php echo $page_js; ?>.js?v=<?php echo filemtime("assets/js/pages/{$page_js}.js"); ?>"></script>
    <?php endif; ?>
    
    <!-- Дополнительные скрипты для калькуляторов -->
    <?php if (in_array($page, ['hosting', 'vds']) || (isset($need_calculator) && $need_calculator)): ?>
        <script src="/assets/js/calculators.js?v=<?php echo filemtime('assets/js/calculators.js'); ?>"></script>
    <?php endif; ?>
    
    <!-- API скрипты для инструментов -->
    <?php if ($page === 'tools' || (isset($need_api) && $need_api)): ?>
        <script src="/assets/js/api.js?v=<?php echo filemtime('assets/js/api.js'); ?>"></script>
    <?php endif; ?>
    
    <!-- Google Analytics (замените на ваш ID) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
    
    <!-- Yandex.Metrica (замените на ваш ID) -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        
        ym(XXXXXXXX, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/XXXXXXXX" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    
    <!-- Inline скрипты -->
    <script>
        // CSRF токен для AJAX запросов
        window.csrfToken = '<?php echo generateCSRFToken(); ?>';
        
        // Конфигурация для скриптов
        window.siteConfig = {
            lang: '<?php echo $current_lang; ?>',
            baseUrl: '<?php echo SITE_URL; ?>',
            recaptchaSiteKey: '<?php echo defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : ''; ?>'
        };
        
        // Переводы для JavaScript
        window.translations = {
            loading: '<?php echo t('loading'); ?>',
            error: '<?php echo t('error'); ?>',
            success: '<?php echo t('success'); ?>',
            confirm: '<?php echo t('confirm'); ?>',
            cancel: '<?php echo t('cancel'); ?>',
            close: '<?php echo t('btn_close'); ?>',
            domain_available: '<?php echo t('domain_available'); ?>',
            domain_unavailable: '<?php echo t('domain_unavailable'); ?>',
            site_online: '<?php echo t('tools_site_online'); ?>',
            site_offline: '<?php echo t('tools_site_offline'); ?>',
            form_required: '<?php echo t('form_required'); ?>',
            form_invalid_email: '<?php echo t('form_invalid_email'); ?>',
            error_csrf_token: '<?php echo t('error_csrf_token'); ?>'
        };
    </script>
    
    <!-- Структурированные данные для локального бизнеса -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "StormHosting UA",
        "image": "<?php echo SITE_URL; ?>/assets/images/logo.png",
        "description": "<?php echo t('site_slogan'); ?>",
        "url": "<?php echo SITE_URL; ?>",
        "telephone": "+380-XX-XXX-XX-XX",
        "email": "<?php echo SITE_EMAIL; ?>",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "UA",
            "addressRegion": "Дніпропетровська область",
            "addressLocality": "Дніпро"
        },
        "openingHours": "Mo-Su 00:00-23:59",
        "sameAs": [
            "https://t.me/stormhosting_ua",
            "https://facebook.com/stormhosting.ua"
        ],
        "offers": {
            "@type": "AggregateOffer",
            "priceCurrency": "UAH",
            "lowPrice": "99",
            "highPrice": "2999",
            "description": "Послуги хостингу та реєстрації доменів"
        }
    }
    </script>
    
    <!-- Дополнительные мета-теги для поисковых систем -->
    <?php if ($page === 'home' || $page === ''): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "StormHosting UA",
        "url": "<?php echo SITE_URL; ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo SITE_URL; ?>/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    <?php endif; ?>
    
</body>
</html>

<?php
// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}
?>