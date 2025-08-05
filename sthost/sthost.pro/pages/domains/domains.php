<?php
// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}

// Настройки страницы
$page_title = 'Домени - StormHosting UA';
$meta_description = 'Реєстрація доменів .ua, .com.ua, .kiev.ua та інших зон в Україні. WHOIS lookup, DNS перевірка, трансфер доменів. Найкращі ціни та підтримка 24/7.';
$meta_keywords = 'домени україна, реєстрація доменів, .ua домени, .com.ua домени, whois, dns, трансфер доменів';
$page_css = 'domains';
$page_js = 'domains';
$need_api = true;

// Получаем статистику доменов
try {
    if (defined('DB_AVAILABLE') && DB_AVAILABLE) {
        // Популярные домены
        $popular_domains = db_fetch_all(
            "SELECT zone, price_registration, 
                    CASE WHEN zone LIKE '%.ua' THEN 1 ELSE 0 END as is_ua_domain
             FROM domain_zones 
             WHERE is_popular = 1 AND is_active = 1 
             ORDER BY is_ua_domain DESC, price_registration ASC 
             LIMIT 6"
        );
        
        // Статистика
        $domain_stats = db_fetch_one(
            "SELECT 
                COUNT(*) as total_zones,
                COUNT(CASE WHEN zone LIKE '%.ua' THEN 1 END) as ua_zones,
                MIN(price_registration) as min_price,
                COUNT(CASE WHEN is_popular = 1 THEN 1 END) as popular_zones
             FROM domain_zones WHERE is_active = 1"
        );
        
        // Последние зарегистрированные домены (заглушка)
        $recent_domains = [
            'mycompany.ua', 'startup.com.ua', 'business.kiev.ua', 
            'shop.com', 'service.org.ua', 'project.net.ua'
        ];
        
    } else {
        throw new Exception('Database not available');
    }
} catch (Exception $e) {
    // Fallback данные
    $popular_domains = [
        ['zone' => '.ua', 'price_registration' => 200, 'is_ua_domain' => 1],
        ['zone' => '.com.ua', 'price_registration' => 150, 'is_ua_domain' => 1],
        ['zone' => '.pp.ua', 'price_registration' => 120, 'is_ua_domain' => 1],
        ['zone' => '.kiev.ua', 'price_registration' => 180, 'is_ua_domain' => 1],
        ['zone' => '.com', 'price_registration' => 350, 'is_ua_domain' => 0],
        ['zone' => '.net', 'price_registration' => 450, 'is_ua_domain' => 0]
    ];
    
    $domain_stats = ['total_zones' => 25, 'ua_zones' => 18, 'min_price' => 120, 'popular_zones' => 6];
    $recent_domains = ['example.ua', 'test.com.ua', 'demo.kiev.ua'];
}

include 'includes/header.php';
?>

<!-- Domains Hero -->
<section class="domain-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Домени для вашого бізнесу</h1>
                <p class="lead mb-4">Знайдіть та зареєструйте ідеальний домен для вашого сайту. Підтримуємо всі популярні українські та міжнародні доменні зони.</p>
                
                <!-- Quick Domain Search -->
                <div class="domain-search-quick">
                    <form id="quickDomainSearch" class="d-flex gap-2 mb-4">
                        <input type="hidden" id="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        <div class="input-group flex-grow-1">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="quickDomainName"
                                   placeholder="введіть назву домену"
                                   pattern="[a-zA-Z0-9-]+"
                                   maxlength="50">
                        </div>
                        <select class="form-select form-select-lg" id="quickDomainZone" style="max-width: 150px;">
                            <option value=".ua">.ua</option>
                            <option value=".com.ua">.com.ua</option>
                            <option value=".com">.com</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    
                    <div id="quickSearchResults"></div>
                </div>
                
                <div class="hero-actions">
                    <a href="/domains/register" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-plus-circle"></i>
                        Зареєструвати домен
                    </a>
                    <a href="/domains/transfer" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-arrow-right-circle"></i>
                        Перенести домен
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-visual text-center">
                    <div class="domain-illustration">
                        <div class="domain-bubble" data-aos="fade-up" data-aos-delay="100">
                            <i class="bi bi-globe"></i>
                            <span>.ua</span>
                        </div>
                        <div class="domain-bubble" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-building"></i>
                            <span>.com.ua</span>
                        </div>
                        <div class="domain-bubble" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-geo-alt"></i>
                            <span>.kiev.ua</span>
                        </div>
                        <div class="domain-bubble" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-person"></i>
                            <span>.pp.ua</span>
                        </div>
                        <div class="domain-bubble central" data-aos="zoom-in" data-aos-delay="500">
                            <i class="bi bi-lightning"></i>
                            <span>StormHosting</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Domain Stats -->
<section class="domain-stats py-4 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $domain_stats['total_zones']; ?></div>
                    <div class="stat-label">Доменних зон</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $domain_stats['ua_zones']; ?></div>
                    <div class="stat-label">Українських зон</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">від <?php echo formatPrice($domain_stats['min_price']); ?></div>
                    <div class="stat-label">Мінімальна ціна</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Підтримка</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="domain-services py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Послуги для доменів</h2>
                <p class="section-subtitle">Повний спектр послуг для управління вашими доменами</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Domain Registration -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <h4>Реєстрація доменів</h4>
                    <p>Швидка реєстрація доменів у всіх популярних зонах з миттєвою активацією.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check"></i> Миттєва активація</li>
                        <li><i class="bi bi-check"></i> Конкурентні ціни</li>
                        <li><i class="bi bi-check"></i> Безкоштовний DNS</li>
                    </ul>
                    <a href="/domains/register" class="btn btn-primary w-100 mt-auto">
                        Зареєструвати домен
                    </a>
                </div>
            </div>
            
            <!-- Domain Transfer -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>
                    <h4>Трансфер доменів</h4>
                    <p>Безкоштовне перенесення доменів від інших реєстраторів з продовженням на рік.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check"></i> Безкоштовний трансфер</li>
                        <li><i class="bi bi-check"></i> +1 рік продовження</li>
                        <li><i class="bi bi-check"></i> Збереження DNS</li>
                    </ul>
                    <a href="/domains/transfer" class="btn btn-outline-primary w-100 mt-auto">
                        Перенести домен
                    </a>
                </div>
            </div>
            
            <!-- WHOIS Lookup -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <h4>WHOIS lookup</h4>
                    <p>Перевірте інформацію про власника домену, дати реєстрації та DNS сервери.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check"></i> Детальна інформація</li>
                        <li><i class="bi bi-check"></i> Всі доменні зони</li>
                        <li><i class="bi bi-check"></i> Безкоштовно</li>
                    </ul>
                    <a href="/domains/whois" class="btn btn-outline-primary w-100 mt-auto">
                        Перевірити WHOIS
                    </a>
                </div>
            </div>
            
            <!-- DNS Tools -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="bi bi-dns"></i>
                    </div>
                    <h4>DNS інструменти</h4>
                    <p>Перевірка DNS записів, діагностика проблем та управління налаштуваннями.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check"></i> Всі типи записів</li>
                        <li><i class="bi bi-check"></i> Діагностика</li>
                        <li><i class="bi bi-check"></i> Експорт даних</li>
                    </ul>
                    <a href="/domains/dns" class="btn btn-outline-primary w-100 mt-auto">
                        Перевірити DNS
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Domains -->
<section class="popular-domains py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Популярні доменні зони</h2>
                <p class="section-subtitle">Найпопулярніші варіанти для українського бізнесу</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($popular_domains as $domain): ?>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="domain-zone-card compact">
                    <div class="zone-header">
                        <div class="zone-name"><?php echo escapeOutput($domain['zone']); ?></div>
                        <?php if ($domain['is_ua_domain']): ?>
                        <span class="badge bg-primary">UA</span>
                        <?php endif; ?>
                    </div>
                    <div class="zone-price">
                        <span class="price"><?php echo formatPrice($domain['price_registration']); ?></span>
                        <span class="period">/ рік</span>
                    </div>
                    <button class="btn btn-sm btn-primary w-100 zone-check-btn" 
                            data-zone="<?php echo escapeOutput($domain['zone']); ?>">
                        Перевірити
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/domains/register" class="btn btn-primary btn-lg">
                Переглянути всі зони
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Recent Activity -->
<section class="recent-activity py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Останні реєстрації</h2>
                <p class="lead mb-4">Приєднуйтесь до тисяч клієнтів, які довіряють нам свої домени</p>
                
                <div class="recent-domains">
                    <?php foreach (array_slice($recent_domains, 0, 6) as $index => $domain): ?>
                    <div class="recent-domain-item" style="animation-delay: <?php echo $index * 0.1; ?>s">
                        <i class="bi bi-check-circle text-success"></i>
                        <span><?php echo escapeOutput($domain); ?></span>
                        <small class="text-muted">щойно зареєстрований</small>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="activity-stats mt-4">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Доменів цього місяця</div>
                        </div>
                        <div class="col-4">
                            <div class="stat-number">5000+</div>
                            <div class="stat-label">Активних доменів</div>
                        </div>
                        <div class="col-4">
                            <div class="stat-number">99.9%</div>
                            <div class="stat-label">Аптайм DNS</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="activity-visual">
                    <div class="activity-chart">
                        <canvas id="domainChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Domain Features -->
<section class="domain-features py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Чому обирають наші домени?</h2>
                <p class="lead">Максимум можливостей для вашого онлайн бізнесу</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon white">
                        <i class="bi bi-lightning"></i>
                    </div>
                    <h4>Миттєва активація</h4>
                    <p>Домен активується автоматично протягом кількох хвилин після оплати</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon white">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Захист конфіденційності</h4>
                    <p>Безкоштовний захист персональних даних у WHOIS базі для всіх доменів</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon white">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h4>Зручне управління</h4>
                    <p>Інтуїтивна панель управління з усіма необхідними функціями</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon white">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h4>Автопродовження</h4>
                    <p>Автоматичне продовження доменів для запобігання втрати контролю</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon white">
                        <i class="bi bi-dns"></i>
                    </div>
                    <h4>Безкоштовний DNS</h4>
                    <p>Управління DNS записами через зручний інтерфейс без додаткової плати</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon white">
                        <i class="bi bi-headphones"></i>
                    </div>
                    <h4>Підтримка 24/7</h4>
                    <p>Кваліфікована технічна підтримка українською мовою цілодобово</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="domain-cta py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Готові зареєструвати свій домен?</h2>
                <p class="lead mb-0">Почніть будувати свій онлайн бізнес з надійного домену від StormHosting UA</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/domains/register" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle"></i>
                    Зареєструвати домен
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Конфігурація для доменної сторінки
window.domainPageConfig = {
    searchUrl: '?ajax=1',
    csrfToken: '<?php echo generateCSRFToken(); ?>',
    popularZones: <?php echo json_encode(array_column($popular_domains, 'zone')); ?>
};

// Швидкий пошук доменів
document.addEventListener('DOMContentLoaded', function() {
    const quickForm = document.getElementById('quickDomainSearch');
    
    if (quickForm) {
        quickForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const domain = document.getElementById('quickDomainName').value;
            const zone = document.getElementById('quickDomainZone').value;
            
            if (domain) {
                // Перенаправляємо на сторінку реєстрації з параметрами
                window.location.href = `/domains/register?domain=${encodeURIComponent(domain)}&zone=${encodeURIComponent(zone)}`;
            }
        });
    }
    
    // Кнопки швидкої перевірки зон
    document.querySelectorAll('.zone-check-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const zone = this.dataset.zone;
            window.location.href = `/domains/register?zone=${encodeURIComponent(zone)}`;
        });
    });
    
    // Анімація останніх доменів
    const recentItems = document.querySelectorAll('.recent-domain-item');
    recentItems.forEach((item, index) => {
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 200);
    });
});
</script>

<?php include 'includes/footer.php'; ?>