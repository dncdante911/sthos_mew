<?php
// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO мета-теги -->
    <title><?php echo escapeOutput($page_title); ?></title>
    <meta name="description" content="<?php echo escapeOutput($meta_description); ?>">
    <meta name="keywords" content="<?php echo escapeOutput($meta_keywords); ?>">
    <meta name="author" content="StormHosting UA">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo escapeOutput($canonical_url); ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo escapeOutput($page_title); ?>">
    <meta property="og:description" content="<?php echo escapeOutput($meta_description); ?>">
    <meta property="og:image" content="<?php echo escapeOutput($og_image); ?>">
    <meta property="og:url" content="<?php echo escapeOutput($canonical_url); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="StormHosting UA">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo escapeOutput($page_title); ?>">
    <meta name="twitter:description" content="<?php echo escapeOutput($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo escapeOutput($og_image); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    
    <!-- Preload важных ресурсов -->
    <link rel="preload" href="/assets/css/main.css" as="style">
    <link rel="preload" href="/assets/js/main.js" as="script">
    <link rel="preload" href="/assets/fonts/roboto-regular.woff2" as="font" type="font/woff2" crossorigin>
    
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/main.css?v=<?php echo filemtime('assets/css/main.css'); ?>">
    <link rel="stylesheet" href="/assets/css/animations.css?v=<?php echo filemtime('assets/css/animations.css'); ?>">
    <link rel="stylesheet" href="/assets/css/responsive.css?v=<?php echo filemtime('assets/css/responsive.css'); ?>">
    
    <?php if (isset($page_css) && !empty($page_css)): ?>
        <link rel="stylesheet" href="/assets/css/pages/<?php echo $page_css; ?>.css?v=<?php echo filemtime("assets/css/pages/{$page_css}.css"); ?>">
    <?php endif; ?>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    
    <!-- reCAPTCHA -->
    <?php if (defined('RECAPTCHA_SITE_KEY')): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php endif; ?>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "StormHosting UA",
        "url": "<?php echo SITE_URL; ?>",
        "logo": "<?php echo SITE_URL; ?>/assets/images/logo.png",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+380-XX-XXX-XX-XX",
            "contactType": "customer service",
            "availableLanguage": ["Ukrainian", "English", "Russian"]
        },
        "sameAs": [
            "https://t.me/stormhosting_ua"
        ]
    }
    </script>
    
    <!-- CSRF токен для AJAX -->
    <meta name="csrf-token" content="<?php echo generateCSRFToken(); ?>">
    
    <!-- Дополнительные мета-теги -->
    <meta name="theme-color" content="#007bff">
    <meta name="msapplication-TileColor" content="#007bff">
    <meta name="format-detection" content="telephone=no">
</head>
<body class="<?php echo $current_lang; ?> page-<?php echo $page; ?> <?php echo isset($body_class) ? $body_class : ''; ?>">
    
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="preloader-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden"><?php echo t('loading'); ?></span>
            </div>
        </div>
    </div>
    
    <!-- Skip to content -->
    <a href="#main-content" class="skip-to-content"><?php echo t('skip_to_content'); ?></a>
    
    <!-- Header -->
    <header class="header" id="header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="contact-info">
                            <span class="contact-item">
                                <i class="bi bi-telephone"></i>
                                <a href="tel:+380XXXXXXXXX">+380 XX XXX XX XX</a>
                            </span>
                            <span class="contact-item">
                                <i class="bi bi-envelope"></i>
                                <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-bar-right">
                            <!-- Переключатель языка -->
                            <div class="language-switcher dropdown">
                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-globe"></i>
                                    <?php echo t('language_' . $current_lang); ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($available_languages as $lang_code): ?>
                                        <?php if ($lang_code !== $current_lang): ?>
                                        <li>
                                            <form method="post" class="language-form">
                                                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                                                <input type="hidden" name="change_language" value="1">
                                                <input type="hidden" name="language" value="<?php echo $lang_code; ?>">
                                                <button type="submit" class="dropdown-item">
                                                    <?php echo t('language_' . $lang_code); ?>
                                                </button>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            
                            <!-- Аккаунт пользователя -->
                            <?php if (isLoggedIn()): ?>
                                <?php $user = getCurrentUser(); ?>
                                <div class="user-menu dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-person"></i>
                                        <?php echo escapeOutput($user['full_name']); ?>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/client"><?php echo t('nav_client_area'); ?></a></li>
                                        <li><a class="dropdown-item" href="/client/settings"><?php echo t('settings'); ?></a></li>
                                        <?php if (isAdmin()): ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="/admin"><?php echo t('admin_panel'); ?></a></li>
                                        <?php endif; ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="/auth/logout"><?php echo t('nav_logout'); ?></a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="auth-links">
                                    <a href="/auth/login" class="btn btn-sm btn-outline-primary"><?php echo t('nav_login'); ?></a>
                                    <a href="/auth/register" class="btn btn-sm btn-primary"><?php echo t('nav_register'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="/">
                    <img src="/assets/images/logos/logo.svg" alt="StormHosting UA" height="40" class="logo">
                    <span class="brand-text">Storm<span class="text-primary">Hosting</span> UA</span>
                </a>
                
                <!-- Mobile menu button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page === 'home' || $page === '') ? 'active' : ''; ?>" href="/">
                                <?php echo t('nav_home'); ?>
                            </a>
                        </li>
                        
                        <!-- Домены -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo ($page === 'domains') ? 'active' : ''; ?>" 
                               href="/domains" data-bs-toggle="dropdown">
                                <?php echo t('nav_domains'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/domains/register"><?php echo t('domains_register'); ?></a></li>
                                <li><a class="dropdown-item" href="/domains/whois"><?php echo t('domains_whois'); ?></a></li>
                                <li><a class="dropdown-item" href="/domains/dns"><?php echo t('domains_dns'); ?></a></li>
                                <li><a class="dropdown-item" href="/domains/transfer"><?php echo t('domains_transfer'); ?></a></li>
                            </ul>
                        </li>
                        
                        <!-- Хостинг -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo ($page === 'hosting') ? 'active' : ''; ?>" 
                               href="/hosting" data-bs-toggle="dropdown">
                                <?php echo t('nav_hosting'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/hosting/shared"><?php echo t('hosting_shared'); ?></a></li>
                                <li><a class="dropdown-item" href="/hosting/cloud"><?php echo t('hosting_cloud'); ?></a></li>
                                <li><a class="dropdown-item" href="/hosting/reseller"><?php echo t('hosting_reseller'); ?></a></li>
                            </ul>
                        </li>
                        
                        <!-- VDS/VPS -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo ($page === 'vds') ? 'active' : ''; ?>" 
                               href="/vds" data-bs-toggle="dropdown">
                                <?php echo t('nav_vds'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/vds/virtual"><?php echo t('vds_virtual'); ?></a></li>
                                <li><a class="dropdown-item" href="/vds/dedicated"><?php echo t('vds_dedicated'); ?></a></li>
                                <li><a class="dropdown-item" href="/vds/calculator"><?php echo t('vds_calculator'); ?></a></li>
                            </ul>
                        </li>
                        
                        <!-- Инструменты -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo ($page === 'tools') ? 'active' : ''; ?>" 
                               href="/tools" data-bs-toggle="dropdown">
                                <?php echo t('nav_tools'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/tools/site-check"><?php echo t('tools_site_check'); ?></a></li>
                                <li><a class="dropdown-item" href="/tools/http-headers"><?php echo t('tools_http_headers'); ?></a></li>
                                <li><a class="dropdown-item" href="/tools/ip-check"><?php echo t('tools_ip_check'); ?></a></li>
                                <li><a class="dropdown-item" href="/tools/site-info"><?php echo t('tools_site_info'); ?></a></li>
                            </ul>
                        </li>
                        
                        <!-- Информация -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo ($page === 'info') ? 'active' : ''; ?>" 
                               href="/info" data-bs-toggle="dropdown">
                                <?php echo t('nav_info'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/info/about"><?php echo t('info_about'); ?></a></li>
                                <li><a class="dropdown-item" href="/info/quality"><?php echo t('info_quality'); ?></a></li>
                                <li><a class="dropdown-item" href="/info/rules"><?php echo t('info_rules'); ?></a></li>
                                <li><a class="dropdown-item" href="/info/legal"><?php echo t('info_legal'); ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/info/faq"><?php echo t('info_faq'); ?></a></li>
                                <li><a class="dropdown-item" href="/info/ssl"><?php echo t('info_ssl'); ?></a></li>
                                <li><a class="dropdown-item" href="/info/complaints"><?php echo t('info_complaints'); ?></a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page === 'contacts') ? 'active' : ''; ?>" href="/contacts">
                                <?php echo t('nav_contacts'); ?>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Поиск -->
                    <form class="d-flex search-form me-3" role="search">
                        <div class="input-group">
                            <input class="form-control form-control-sm" type="search" placeholder="<?php echo t('search_placeholder'); ?>" aria-label="Search">
                            <button class="btn btn-outline-secondary btn-sm" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- CTA кнопка -->
                    <div class="header-cta">
                        <a href="/hosting" class="btn btn-primary btn-sm">
                            <?php echo t('hero_cta_hosting'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Flash Messages -->
    <?php echo getFlashMessage(); ?>
    
    <!-- Main Content -->
    <main id="main-content" class="main-content"><?php