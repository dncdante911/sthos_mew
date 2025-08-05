<?php
// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}

// Настройки страницы
$page_title = t('site_name') . ' - ' . t('site_slogan');
$meta_description = 'StormHosting UA - надійний хостинг провайдер України. Хостинг сайтів, VDS/VPS сервери, реєстрація доменів. Підтримка 24/7, SSL сертифікати, 99.9% аптайм.';
$meta_keywords = 'хостинг україна, vps сервер, реєстрація домену, ssl сертифікат, хостинг сайтів, дешевий хостинг';
$page_css = 'index';
$page_js = 'index';

// Получение данных для главной страницы
try {
    // Популярные доменные зоны
    $popular_domains = db_fetch_all(
        "SELECT zone, price_registration FROM domain_zones WHERE is_popular = 1 AND is_active = 1 ORDER BY price_registration ASC LIMIT 6"
    );
    
    // Популярные хостинг планы
    $popular_hosting = db_fetch_all(
        "SELECT * FROM hosting_plans WHERE is_active = 1 ORDER BY is_popular DESC, price_monthly ASC LIMIT 3"
    );
    
    // Последние новости
    $latest_news = db_fetch_all(
        "SELECT id, title_{$current_lang} as title, content_{$current_lang} as content, image, created_at 
         FROM news 
         WHERE is_published = 1 
         ORDER BY is_featured DESC, created_at DESC 
         LIMIT 4"
    );
    
} catch (Exception $e) {
    // В случае ошибки БД используем заглушки
    $popular_domains = [];
    $popular_hosting = [];
    $latest_news = [];
    error_log("Homepage data fetch error: " . $e->getMessage());
}

// Подключение шапки
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-animation">
            <div class="floating-icons">
                <div class="icon-server"><i class="bi bi-server"></i></div>
                <div class="icon-globe"><i class="bi bi-globe"></i></div>
                <div class="icon-shield"><i class="bi bi-shield-check"></i></div>
                <div class="icon-lightning"><i class="bi bi-lightning"></i></div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span class="highlight"><?php echo t('hero_title'); ?></span>
                    </h1>
                    <p class="hero-subtitle"><?php echo t('hero_subtitle'); ?></p>
                    
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number">99.9%</div>
                            <div class="stat-label"><?php echo t('uptime'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label"><?php echo t('support'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">5000+</div>
                            <div class="stat-label"><?php echo t('clients'); ?></div>
                        </div>
                    </div>
                    
                    <div class="hero-actions">
                        <a href="/hosting" class="btn btn-primary btn-lg">
                            <i class="bi bi-rocket-takeoff"></i>
                            <?php echo t('hero_cta_hosting'); ?>
                        </a>
                        <a href="/domains" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-globe"></i>
                            <?php echo t('hero_cta_domain'); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-visual">
                    <div class="server-illustration">
                        <div class="server-rack">
                            <div class="server-unit active">
                                <div class="server-lights">
                                    <span class="light green"></span>
                                    <span class="light green"></span>
                                    <span class="light blue"></span>
                                </div>
                            </div>
                            <div class="server-unit active">
                                <div class="server-lights">
                                    <span class="light green"></span>
                                    <span class="light yellow"></span>
                                    <span class="light green"></span>
                                </div>
                            </div>
                            <div class="server-unit">
                                <div class="server-lights">
                                    <span class="light red"></span>
                                    <span class="light gray"></span>
                                    <span class="light gray"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="connection-lines">
                        <svg viewBox="0 0 300 200" class="connections">
                            <defs>
                                <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#007bff;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#28a745;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path d="M50,100 Q150,50 250,100" stroke="url(#lineGradient)" stroke-width="2" fill="none" class="connection-line" />
                            <path d="M50,120 Q150,170 250,120" stroke="url(#lineGradient)" stroke-width="2" fill="none" class="connection-line" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="scroll-indicator">
        <div class="scroll-down">
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5" id="features">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo t('features_title'); ?></h2>
                <p class="section-subtitle"><?php echo t('features_subtitle'); ?></p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h4 class="feature-title"><?php echo t('feature_speed_title'); ?></h4>
                    <p class="feature-description"><?php echo t('feature_speed_desc'); ?></p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4 class="feature-title"><?php echo t('feature_support_title'); ?></h4>
                    <p class="feature-description"><?php echo t('feature_support_desc'); ?></p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="feature-title"><?php echo t('feature_ssl_title'); ?></h4>
                    <p class="feature-description"><?php echo t('feature_ssl_desc'); ?></p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-cloud-upload"></i>
                    </div>
                    <h4 class="feature-title"><?php echo t('feature_backup_title'); ?></h4>
                    <p class="feature-description"><?php echo t('feature_backup_desc'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Domains Section -->
<?php if (!empty($popular_domains)): ?>
<section class="domains-section py-5 bg-light" id="domains">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo t('popular_domains_title'); ?></h2>
                <p class="section-subtitle"><?php echo t('register_domain_today'); ?></p>
            </div>
        </div>
        
        <div class="row g-3 justify-content-center">
            <?php foreach ($popular_domains as $domain): ?>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="domain-card">
                    <div class="domain-zone"><?php echo escapeOutput($domain['zone']); ?></div>
                    <div class="domain-price">
                        <span class="price-from"><?php echo t('domain_from'); ?></span>
                        <span class="price-amount"><?php echo formatPrice($domain['price_registration']); ?></span>
                        <span class="price-period"><?php echo t('domain_per_year'); ?></span>
                    </div>
                    <a href="/domains/register?zone=<?php echo urlencode($domain['zone']); ?>" class="btn btn-primary btn-sm w-100">
                        <?php echo t('register_now'); ?>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/domains" class="btn btn-outline-primary">
                <?php echo t('view_all_domains'); ?>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Hosting Plans Section -->
<?php if (!empty($popular_hosting)): ?>
<section class="hosting-plans-section py-5" id="hosting">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo t('hosting_plans_title'); ?></h2>
                <p class="section-subtitle"><?php echo t('choose_perfect_plan'); ?></p>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            <?php foreach ($popular_hosting as $plan): ?>
            <div class="col-lg-4 col-md-6">
                <div class="hosting-plan-card <?php echo $plan['is_popular'] ? 'popular' : ''; ?>">
                    <?php if ($plan['is_popular']): ?>
                    <div class="popular-badge"><?php echo t('hosting_popular'); ?></div>
                    <?php endif; ?>
                    
                    <div class="plan-header">
                        <h3 class="plan-name"><?php echo escapeOutput($plan['name_' . $current_lang] ?: $plan['name_ua']); ?></h3>
                        <div class="plan-price">
                            <span class="price-amount"><?php echo formatPrice($plan['price_monthly']); ?></span>
                            <span class="price-period"><?php echo t('hosting_per_month'); ?></span>
                        </div>
                        <div class="plan-save">
                            <small><?php echo t('yearly_price'); ?>: <?php echo formatPrice($plan['price_yearly']); ?></small>
                        </div>
                    </div>
                    
                    <div class="plan-features">
                        <ul>
                            <li><i class="bi bi-check"></i> <?php echo $plan['disk_space'] / 1024; ?> ГБ <?php echo t('hosting_disk_space'); ?></li>
                            <li><i class="bi bi-check"></i> <?php echo $plan['bandwidth']; ?> ГБ <?php echo t('hosting_bandwidth'); ?></li>
                            <li><i class="bi bi-check"></i> <?php echo $plan['databases']; ?> <?php echo t('hosting_databases'); ?></li>
                            <li><i class="bi bi-check"></i> <?php echo $plan['email_accounts']; ?> <?php echo t('hosting_email_accounts'); ?></li>
                            <li><i class="bi bi-check"></i> <?php echo t('hosting_ssl'); ?></li>
                            <li><i class="bi bi-check"></i> <?php echo t('hosting_backup'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="plan-footer">
                        <a href="/hosting/order?plan=<?php echo $plan['id']; ?>" class="btn btn-primary w-100">
                            <?php echo t('hosting_order_now'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/hosting" class="btn btn-outline-primary">
                <?php echo t('view_all_plans'); ?>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- News Section -->
<?php if (!empty($latest_news)): ?>
<section class="news-section py-5 bg-light" id="news">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo t('news_title'); ?></h2>
                <p class="section-subtitle"><?php echo t('stay_updated'); ?></p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($latest_news as $news): ?>
            <div class="col-lg-3 col-md-6">
                <article class="news-card">
                    <?php if ($news['image']): ?>
                    <div class="news-image">
                        <img src="<?php echo escapeOutput($news['image']); ?>" alt="<?php echo escapeOutput($news['title']); ?>" loading="lazy">
                    </div>
                    <?php endif; ?>
                    
                    <div class="news-content">
                        <div class="news-date">
                            <i class="bi bi-calendar"></i>
                            <?php echo formatDate($news['created_at'], 'd.m.Y'); ?>
                        </div>
                        
                        <h3 class="news-title">
                            <a href="/news/<?php echo $news['id']; ?>"><?php echo escapeOutput($news['title']); ?></a>
                        </h3>
                        
                        <p class="news-excerpt">
                            <?php echo escapeOutput(mb_substr(strip_tags($news['content']), 0, 120)); ?>...
                        </p>
                        
                        <a href="/news/<?php echo $news['id']; ?>" class="news-link">
                            <?php echo t('read_more'); ?>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/news" class="btn btn-outline-primary">
                <?php echo t('all_news'); ?>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="cta-content">
                    <h2 class="cta-title"><?php echo t('ready_to_start'); ?></h2>
                    <p class="cta-subtitle"><?php echo t('join_thousands_clients'); ?></p>
                    
                    <div class="cta-actions">
                        <a href="/hosting" class="btn btn-primary btn-lg">
                            <?php echo t('get_started_now'); ?>
                        </a>
                        <a href="/contacts" class="btn btn-outline-primary btn-lg">
                            <?php echo t('contact_us'); ?>
                        </a>
                    </div>
                    
                    <div class="cta-features">
                        <div class="feature">
                            <i class="bi bi-check-circle"></i>
                            <span><?php echo t('instant_activation'); ?></span>
                        </div>
                        <div class="feature">
                            <i class="bi bi-check-circle"></i>
                            <span><?php echo t('money_back_guarantee'); ?></span>
                        </div>
                        <div class="feature">
                            <i class="bi bi-check-circle"></i>
                            <span><?php echo t('free_migration'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Подключение подвала
include 'includes/footer.php';
?>