<?php
// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}

// Настройки страницы
$page_title = t('domains_register') . ' - ' . t('site_name');
$meta_description = 'Реєстрація доменів .ua, .com.ua, .kiev.ua, .pp.ua та інших. Найкращі ціни на домени в Україні. Миттєва активація, безкоштовне керування DNS.';
$meta_keywords = 'реєстрація доменalberto .ua, домен .com.ua, домен .kiev.ua, домен .pp.ua, дешеві домени україна';
$page_css = 'domains-register';
$page_js = 'domains-register';
$need_api = true;

// Получаем доменные зоны из БД
try {
    if (defined('DB_AVAILABLE') && DB_AVAILABLE) {
        // Популярные домены
        $popular_domains = db_fetch_all(
            "SELECT * FROM popular_domains_view LIMIT 8"
        );
        
        // Все активные зоны для поиска
        $all_zones = db_fetch_all(
            "SELECT zone, price_registration, 
                    CASE WHEN zone LIKE '%.ua' THEN 1 ELSE 0 END as is_ua_domain
             FROM domain_zones 
             WHERE is_active = 1 
             ORDER BY is_ua_domain DESC, price_registration ASC"
        );
        
        // Статистика по доменам
        $domain_stats = db_fetch_one(
            "SELECT 
                COUNT(*) as total_zones,
                COUNT(CASE WHEN zone LIKE '%.ua' THEN 1 END) as ua_zones,
                MIN(price_registration) as min_price,
                MAX(price_registration) as max_price
             FROM domain_zones WHERE is_active = 1"
        );
    } else {
        throw new Exception('Database not available');
    }
} catch (Exception $e) {
    // Fallback данные
    $popular_domains = [
        ['zone' => '.ua', 'price_registration' => 200, 'domain_type' => 'Український домен', 'price_category' => 'Стандарт'],
        ['zone' => '.com.ua', 'price_registration' => 150, 'domain_type' => 'Український домен', 'price_category' => 'Економ'],
        ['zone' => '.pp.ua', 'price_registration' => 120, 'domain_type' => 'Український домен', 'price_category' => 'Економ'],
        ['zone' => '.kiev.ua', 'price_registration' => 180, 'domain_type' => 'Український домен', 'price_category' => 'Стандарт'],
        ['zone' => '.net.ua', 'price_registration' => 180, 'domain_type' => 'Український домен', 'price_category' => 'Стандарт'],
        ['zone' => '.org.ua', 'price_registration' => 180, 'domain_type' => 'Український домен', 'price_category' => 'Стандарт'],
        ['zone' => '.com', 'price_registration' => 350, 'domain_type' => 'Міжнародний домен', 'price_category' => 'Преміум'],
        ['zone' => '.net', 'price_registration' => 450, 'domain_type' => 'Міжнародний домен', 'price_category' => 'Преміум']
    ];
    
    $all_zones = $popular_domains;
    $domain_stats = ['total_zones' => count($popular_domains), 'ua_zones' => 6, 'min_price' => 120, 'max_price' => 450];
}

// Обработка AJAX запросов для проверки доменов
if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    header('Content-Type: application/json; charset=utf-8');
    
    if ($_POST['action'] === 'check_domain') {
        if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
            echo json_encode(['error' => t('error_csrf_token')]);
            exit;
        }
        
        $domain = sanitizeInput($_POST['domain'] ?? '');
        $zone = sanitizeInput($_POST['zone'] ?? '');
        
        if (empty($domain)) {
            echo json_encode(['error' => 'Введіть ім\'я домену']);
            exit;
        }
        
        // Простая проверка формата домена
        if (!preg_match('/^[a-zA-Z0-9-]+$/', $domain)) {
            echo json_encode(['error' => 'Недопустимі символи в імені домену']);
            exit;
        }
        
        $full_domain = $domain . $zone;
        
        // Здесь будет реальная проверка через WHOIS API
        // Пока что делаем псевдослучайную проверку
        $is_available = (crc32($full_domain) % 3) !== 0; // ~66% доменов доступны
        
        // Получаем цену для зоны
        $zone_info = null;
        foreach ($all_zones as $z) {
            if ($z['zone'] === $zone) {
                $zone_info = $z;
                break;
            }
        }
        
        if (!$zone_info) {
            echo json_encode(['error' => 'Домен зона не поддерживается']);
            exit;
        }
        
        echo json_encode([
            'domain' => $full_domain,
            'available' => $is_available,
            'price' => $zone_info['price_registration'],
            'currency' => 'грн',
            'message' => $is_available ? 'Домен доступен для регистрации!' : 'Домен уже зарегистрирован'
        ]);
        exit;
    }
}

// Подключаем header
include 'includes/header.php';
?>

<!-- Domain Search Hero -->
<section class="domain-hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-4 fw-bold mb-4"><?php echo t('domains_register'); ?></h1>
                <p class="lead mb-5">Знайдіть і зареєструйте ідеальний домен для вашого сайту. Підтримуємо всі популярні українські доменні зони.</p>
                
                <!-- Domain Search Form -->
                <div class="domain-search-form">
                    <form id="domainSearchForm" class="d-flex flex-column flex-md-row gap-3 justify-content-center align-items-stretch">
                        <input type="hidden" id="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        
                        <div class="input-group domain-input-group">
                            <span class="input-group-text">
                                <i class="bi bi-globe"></i>
                            </span>
                            <input type="text" 
                                   id="domainName" 
                                   class="form-control form-control-lg" 
                                   placeholder="назва-вашого-сайту"
                                   pattern="[a-zA-Z0-9-]+"
                                   maxlength="50"
                                   required>
                        </div>
                        
                        <select id="domainZone" class="form-select form-select-lg">
                            <?php foreach ($popular_domains as $domain): ?>
                            <option value="<?php echo escapeOutput($domain['zone']); ?>" 
                                    data-price="<?php echo $domain['price_registration']; ?>">
                                <?php echo escapeOutput($domain['zone']); ?> 
                                (<?php echo formatPrice($domain['price_registration']); ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-search"></i>
                            <?php echo t('domain_search_button'); ?>
                        </button>
                    </form>
                    
                    <!-- Search Results -->
                    <div id="searchResults" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Domain Statistics -->
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

<!-- Popular Domains -->
<section class="popular-domains py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Популярні доменні зони</h2>
                <p class="section-subtitle">Оберіть найкращий домен для вашого проекту</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($popular_domains as $domain): ?>
            <div class="col-lg-3 col-md-6">
                <div class="domain-zone-card h-100" data-zone="<?php echo escapeOutput($domain['zone']); ?>">
                    <div class="card-header">
                        <div class="domain-zone"><?php echo escapeOutput($domain['zone']); ?></div>
                        <div class="domain-type"><?php echo escapeOutput($domain['domain_type']); ?></div>
                    </div>
                    
                    <div class="card-body">
                        <div class="price-display">
                            <div class="price-amount"><?php echo formatPrice($domain['price_registration']); ?></div>
                            <div class="price-period">за перший рік</div>
                        </div>
                        
                        <div class="price-category badge bg-<?php echo $domain['price_category'] === 'Економ' ? 'success' : ($domain['price_category'] === 'Стандарт' ? 'primary' : 'warning'); ?>">
                            <?php echo escapeOutput($domain['price_category']); ?>
                        </div>
                        
                        <ul class="domain-features">
                            <li><i class="bi bi-check text-success"></i> Безкоштовне керування DNS</li>
                            <li><i class="bi bi-check text-success"></i> Захист конфіденційності WHOIS</li>
                            <li><i class="bi bi-check text-success"></i> Автопродовження</li>
                            <li><i class="bi bi-check text-success"></i> Підтримка 24/7</li>
                        </ul>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-primary w-100 quick-search-btn" 
                                data-zone="<?php echo escapeOutput($domain['zone']); ?>">
                            Перевірити доступність
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Domain Features -->
<section class="domain-features py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Переваги реєстрації доменів у нас</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h4>Миттєва активація</h4>
                    <p>Домен активується автоматично протягом декількох хвилин після оплати</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Захист приватності</h4>
                    <p>Безкоштовний захист персональних даних в WHOIS базі</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon text-center">
                    <div class="feature-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h4>Повне керування</h4>
                    <p>Зручна панель управління доменом з усіма необхідними функціями</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h4>Безкоштовне перенесення</h4>
                    <p>Перенесіть свій домен від іншого реєстратора абсолютно безкоштовно</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon">
                        <i class="bi bi-dns"></i>
                    </div>
                    <h4>Керування DNS</h4>
                    <p>Повний контроль над DNS записами через зручний інтерфейс</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon">
                        <i class="bi bi-headphones"></i>
                    </div>
                    <h4>Підтримка 24/7</h4>
                    <p>Кваліфікована технічна підтримка доступна цілодобово</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Domain Transfer -->
<section class="domain-transfer py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold">Перенесення домену</h2>
                <p class="lead">Маєте домен у іншого реєстратора? Перенесіть його до нас і отримайте:</p>
                
                <ul class="transfer-benefits">
                    <li><i class="bi bi-check-circle text-success"></i> Безкоштовне перенесення</li>
                    <li><i class="bi bi-check-circle text-success"></i> Продовження на 1 рік</li>
                    <li><i class="bi bi-check-circle text-success"></i> Кращі ціни на продовження</li>
                    <li><i class="bi bi-check-circle text-success"></i> Професійну підтримку</li>
                </ul>
                
                <a href="/domains/transfer" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-arrow-right-circle"></i>
                    Перенести домен
                </a>
            </div>
            
            <div class="col-lg-6">
                <div class="transfer-visual">
                    <div class="transfer-steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-text">Отримайте код авторизації</div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-text">Подайте заявку на перенесення</div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-text">Підтвердьте перенесення</div>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <div class="step-text">Готово! Домен у вас</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Константы для скрипта
window.domainConfig = {
    searchUrl: '?ajax=1',
    csrfToken: '<?php echo generateCSRFToken(); ?>',
    zones: <?php echo json_encode($all_zones); ?>,
    translations: {
        searching: 'Перевіряємо доступність...',
        available: 'Домен доступний!',
        unavailable: 'Домен зайнятий',
        error: 'Помилка перевірки'
    }
};
</script>

<?php include 'includes/footer.php'; ?>