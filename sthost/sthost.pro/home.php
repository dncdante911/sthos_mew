<?php
/**
 * StormHosting UA - Главная страница
 * Файл: /pages/home.php
 */

// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    die('Доступ запрещен');
}

// Настройки страницы
$page = 'home';
$page_title = 'StormHosting UA - Надійний хостинг-провайдер України';
$meta_description = 'StormHosting UA - професійний хостинг, VDS/VPS сервери, реєстрація доменів. Швидкі SSD диски, безкоштовний SSL, підтримка 24/7. Найкращі ціни в Україні!';
$meta_keywords = 'хостинг україна, vps сервер, vds хостинг, реєстрація домену, ssl сертифікат, хостинг сайтів, дешевий хостинг, швидкий хостинг';
$og_title = 'StormHosting UA - Професійний хостинг з підтримкою 24/7';
$og_description = 'Швидкі SSD сервери, безкоштовний SSL, миттєва активація. Найкращий хостинг для вашого бізнесу!';
$og_image = '/assets/images/og/home-og.jpg';

// CSS стили для главной
$page_css = [
    '/assets/css/pages/home.css'
];

// JavaScript для главной
$page_js = [
    '/assets/js/pages/home.js'
];

// Заглушки для функций если не определены
if (!function_exists('getPopularDomains')) {
    function getPopularDomains() {
        return [
            ['zone' => '.com.ua', 'price' => 150, 'old_price' => 200],
            ['zone' => '.ua', 'price' => 250, 'old_price' => 300],
            ['zone' => '.com', 'price' => 450, 'old_price' => 550],
            ['zone' => '.net', 'price' => 500, 'old_price' => 600],
            ['zone' => '.org', 'price' => 480, 'old_price' => 580],
            ['zone' => '.info', 'price' => 320, 'old_price' => 400]
        ];
    }
}

if (!function_exists('getLatestNews')) {
    function getLatestNews() {
        return [
            [
                'id' => 1,
                'title' => 'Запуск нових VPS серверів на NVMe дисках',
                'excerpt' => 'Ми розширили наш парк серверів новими потужними VPS з NVMe накопичувачами для максимальної швидкості.',
                'date' => '2024-01-15',
                'image' => '/assets/images/news/nvme-servers.jpg',
                'category' => 'Новини'
            ],
            [
                'id' => 2,
                'title' => 'Безкоштовні SSL сертифікати для всіх клієнтів',
                'excerpt' => 'Тепер всі наші клієнти отримують безкоштовні SSL сертифікати Let\'s Encrypt з автоматичним продовженням.',
                'date' => '2024-01-10',
                'image' => '/assets/images/news/ssl-free.jpg',
                'category' => 'Акції'
            ],
            [
                'id' => 3,
                'title' => 'Знижки до 50% на хостинг при річному платежі',
                'excerpt' => 'Святкова акція! Оплачуйте хостинг на рік наперед та отримуйте знижку до 50% на всі тарифні плани.',
                'date' => '2024-01-05',
                'image' => '/assets/images/news/discount-50.jpg',
                'category' => 'Акції'
            ]
        ];
    }
}

if (!function_exists('getHostingPlans')) {
    function getHostingPlans() {
        return [
            [
                'name' => 'Start',
                'price' => 99,
                'old_price' => 149,
                'disk' => '5 ГБ',
                'bandwidth' => '50 ГБ',
                'domains' => '1',
                'features' => ['cPanel', 'PHP 8.x', 'MySQL', 'SSL сертифікат']
            ],
            [
                'name' => 'Basic',
                'price' => 199,
                'old_price' => 249,
                'disk' => '20 ГБ',
                'bandwidth' => '200 ГБ',
                'domains' => '5',
                'features' => ['cPanel', 'PHP 8.x', 'MySQL', 'SSL сертифікат'],
                'popular' => true
            ],
            [
                'name' => 'Pro',
                'price' => 399,
                'old_price' => 499,
                'disk' => '50 ГБ',
                'bandwidth' => 'Безлімітно',
                'domains' => '20',
                'features' => ['cPanel', 'PHP 8.x', 'MySQL', 'SSL сертифікат']
            ]
        ];
    }
}

// Получаем данные
$popular_domains = getPopularDomains();
$latest_news = getLatestNews();
$hosting_plans = getHostingPlans();
?>

<style>
/* CSS стили для главной страницы встроены для гарантии работы */
.home-page {
    overflow-x: hidden;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    color: white;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('/assets/images/patterns/grid.svg') repeat;
    opacity: 0.1;
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 3;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.hero-buttons .btn {
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 50px;
    margin: 0 10px 10px 0;
    transition: all 0.3s ease;
}

.btn-hero-primary {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    backdrop-filter: blur(10px);
}

.btn-hero-primary:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.btn-hero-outline {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.5);
    color: white;
}

.btn-hero-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

/* Floating Elements */
.floating-servers {
    position: absolute;
    right: 10%;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
}

.server-icon {
    width: 60px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    margin: 20px 0;
    position: relative;
    backdrop-filter: blur(10px);
    animation: float 3s ease-in-out infinite;
}

.server-icon:nth-child(2) {
    animation-delay: 0.5s;
    margin-left: 30px;
}

.server-icon:nth-child(3) {
    animation-delay: 1s;
}

.server-icon::before {
    content: '';
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 8px;
    height: 8px;
    background: #00ff88;
    border-radius: 50%;
    animation: blink 2s infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.3; }
}

/* Stats Section */
.stats-section {
    background: #f8fafc;
    padding: 80px 0;
}

.stat-card {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    color: #6b7280;
    font-weight: 500;
}

/* Popular Hosting */
.hosting-section {
    padding: 80px 0;
    background: white;
}

.hosting-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 2px solid #f3f4f6;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hosting-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.hosting-card:hover::before {
    transform: scaleX(1);
}

.hosting-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: #667eea;
}

.hosting-card.popular {
    border-color: #667eea;
    transform: scale(1.05);
}

.hosting-card.popular::before {
    transform: scaleX(1);
}

.popular-badge {
    position: absolute;
    top: -10px;
    right: 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 5px 15px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.hosting-price {
    font-size: 2.5rem;
    font-weight: 700;
    color: #667eea;
    margin: 1rem 0;
}

.hosting-price small {
    font-size: 1rem;
    color: #6b7280;
}

.old-price {
    text-decoration: line-through;
    color: #9ca3af;
    font-size: 1.2rem;
    margin-left: 10px;
}

.hosting-features {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0;
}

.hosting-features li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    align-items: center;
}

.hosting-features li:last-child {
    border-bottom: none;
}

.hosting-features li::before {
    content: '✓';
    color: #10b981;
    font-weight: bold;
    margin-right: 10px;
}

/* Popular Domains */
.domains-section {
    background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
    padding: 80px 0;
}

.domain-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.domain-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: #667eea;
}

.domain-zone {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
}

.domain-price {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 0.5rem;
}

.domain-old-price {
    text-decoration: line-through;
    color: #9ca3af;
    font-size: 1rem;
}

.domain-period {
    color: #6b7280;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

/* News Section */
.news-section {
    padding: 80px 0;
    background: white;
}

.news-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.news-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.news-image {
    height: 200px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    position: relative;
    overflow: hidden;
}

.news-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.9);
    color: #667eea;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.news-content {
    padding: 1.5rem;
}

.news-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.news-excerpt {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.news-date {
    color: #9ca3af;
    font-size: 0.85rem;
}

/* Newsletter */
.newsletter-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px 0;
}

.newsletter-form {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(10px);
}

.newsletter-input {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 50px;
    padding: 12px 20px;
    margin-right: 10px;
}

.newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.newsletter-input:focus {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

/* Quick Actions */
.quick-actions {
    background: #f8fafc;
    padding: 60px 0;
}

.action-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid #f3f4f6;
    height: 100%;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: #667eea;
}

.action-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta-subtitle {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .floating-servers {
        display: none;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
    
    .hosting-card.popular {
        transform: none;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
    
    .newsletter-input {
        margin-bottom: 1rem;
        margin-right: 0;
        width: 100%;
    }
}
</style>

<div class="home-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4 class="mb-3">WHOIS перевірка</h4>
                        <p class="text-muted mb-4">Дізнайтеся інформацію про власника домену</p>
                        <a href="/pages/domains/whois.php" class="btn btn-outline-primary">Перевірити</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <h4 class="mb-3">Перевірка сайту</h4>
                        <p class="text-muted mb-4">Протестуйте швидкість та доступність сайту</p>
                        <a href="/pages/tools/site-check.php" class="btn btn-outline-primary">Перевірити</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4 class="mb-3">Перевірка IP</h4>
                        <p class="text-muted mb-4">Визначте геолокацію та інформацію про IP</p>
                        <a href="/pages/tools/ip-check.php" class="btn btn-outline-primary">Перевірити</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-calculator"></i>
                        </div>
                        <h4 class="mb-3">Калькулятор VDS</h4>
                        <p class="text-muted mb-4">Розрахуйте вартість VDS сервера</p>
                        <a href="/pages/vds/vds-calc.php" class="btn btn-outline-primary">Розрахувати</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Subscription -->
    <section class="newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3">Підпишіться на новини</h2>
                    <p class="mb-4 opacity-75">Отримуйте актуальну інформацію про акції, новини та оновлення</p>
                    
                    <form class="newsletter-form" id="newsletter-form">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <input type="email" class="form-control newsletter-input" placeholder="Ваш email адрес" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-light btn-lg w-100">
                                    <i class="bi bi-envelope"></i>
                                    Підписатися
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="cta-title">Готові почати?</h2>
            <p class="cta-subtitle">Приєднуйтеся до тисяч задоволених клієнтів StormHosting</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="/pages/hosting/shared.php" class="btn btn-primary btn-lg">
                    <i class="bi bi-rocket-takeoff"></i>
                    Замовити хостинг
                </a>
                <a href="/pages/vds/virtual.php" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-server"></i>
                    VDS сервери
                </a>
                <a href="/pages/info/about.php" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-info-circle"></i>
                    Про нас
                </a>
            </div>
        </div>
    </section>
</div>

<script>
// JavaScript для главной страницы встроен для гарантии работы
document.addEventListener('DOMContentLoaded', function() {
    // Анимация счетчиков статистики
    const animateCounters = () => {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 секунды
            const increment = target / (duration / 16); // 60 FPS
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    if (current > target) current = target;
                    
                    // Форматирование числа
                    if (target === 99.9) {
                        counter.textContent = current.toFixed(1);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                    
                    requestAnimationFrame(updateCounter);
                } else {
                    // Финальное значение
                    if (target === 99.9) {
                        counter.textContent = target.toFixed(1);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                }
            };
            
            updateCounter();
        });
    };

    // Intersection Observer для запуска анимации при прокрутке
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                statsObserver.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Плавная прокрутка для якорных ссылок
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Обработка формы подписки на новости
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            // Показываем индикатор загрузки
            button.innerHTML = '<i class="bi bi-hourglass-split"></i> Підписуємо...';
            button.disabled = true;
            
            // Имитация AJAX запроса (замените на реальный)
            setTimeout(() => {
                // Показываем сообщение об успехе
                showToast('Дякуємо за підписку! Перевірте ваш email.', 'success');
                
                // Сбрасываем форму
                this.reset();
                
                // Возвращаем кнопку в исходное состояние
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        });
    }

    // Параллакс эффект для hero секции
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            if (scrolled < heroSection.offsetHeight) {
                heroSection.style.transform = `translateY(${rate}px)`;
            }
        });
    }

    // Анимация появления элементов при прокрутке
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Применяем анимацию к карточкам
    document.querySelectorAll('.hosting-card, .domain-card, .news-card, .action-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Функция показа уведомлений
    function showToast(message, type = 'info') {
        // Создаем контейнер для toast если его нет
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        // Создаем toast
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'primary'} border-0`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        toastContainer.appendChild(toast);

        // Показываем toast
        const bsToast = new bootstrap.Toast(toast, {
            autohide: true,
            delay: 5000
        });
        bsToast.show();

        // Удаляем toast после скрытия
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    // Добавляем CSS стили для toast контейнера если Bootstrap toast CSS не загружен
    if (!document.querySelector('style[data-toast-styles]')) {
        const toastStyles = document.createElement('style');
        toastStyles.setAttribute('data-toast-styles', 'true');
        toastStyles.textContent = `
            .toast {
                min-width: 300px;
                backdrop-filter: blur(10px);
            }
            .toast-body {
                padding: 0.75rem;
            }
        `;
        document.head.appendChild(toastStyles);
    }
});
</script> class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Професійний хостинг<br>
                            з підтримкою <span style="color: #00ff88;">24/7</span>
                        </h1>
                        <p class="hero-subtitle">
                            Швидкі SSD сервери, безкоштовний SSL, миттєва активація.<br>
                            Найкращий хостинг для вашого бізнесу в Україні!
                        </p>
                        <div class="hero-buttons">
                            <a href="/pages/hosting/shared.php" class="btn btn-hero-primary btn-lg">
                                <i class="bi bi-rocket-takeoff"></i>
                                Замовити хостинг
                            </a>
                            <a href="/pages/domains/register.php" class="btn btn-hero-outline btn-lg">
                                <i class="bi bi-globe"></i>
                                Купити домен
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Servers Animation -->
        <div class="floating-servers d-none d-lg-block">
            <div class="server-icon"></div>
            <div class="server-icon"></div>
            <div class="server-icon"></div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number" data-target="15000">0</div>
                        <div class="stat-label">Активних сайтів</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number" data-target="99.9">0</div>
                        <div class="stat-label">% Аптайм</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number" data-target="8">0</div>
                        <div class="stat-label">Років досвіду</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number" data-target="24">0</div>
                        <div class="stat-label">Години підтримки</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Hosting Plans -->
    <section class="hosting-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Популярні тарифи хостингу</h2>
                    <p class="section-subtitle">Оберіть найкращий план для вашого проекту</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($hosting_plans as $plan): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="hosting-card <?php echo isset($plan['popular']) ? 'popular' : ''; ?>">
                        <?php if (isset($plan['popular'])): ?>
                        <div class="popular-badge">Популярний</div>
                        <?php endif; ?>
                        
                        <h3 class="text-center mb-3"><?php echo $plan['name']; ?></h3>
                        <div class="text-center">
                            <div class="hosting-price">
                                <?php echo $plan['price']; ?> грн
                                <small>/міс</small>
                                <?php if ($plan['old_price']): ?>
                                <span class="old-price"><?php echo $plan['old_price']; ?> грн</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <ul class="hosting-features">
                            <li><strong>Дисковий простір:</strong> <?php echo $plan['disk']; ?></li>
                            <li><strong>Трафік:</strong> <?php echo $plan['bandwidth']; ?></li>
                            <li><strong>Доменів:</strong> <?php echo $plan['domains']; ?></li>
                            <?php foreach ($plan['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div class="text-center">
                            <a href="/pages/hosting/shared.php" class="btn btn-primary btn-lg w-100">
                                Замовити
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Popular Domains -->
    <section class="domains-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Популярні доменні зони</h2>
                    <p class="section-subtitle">Зареєструйте свій домен за найкращою ціною</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($popular_domains as $domain): ?>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="domain-card">
                        <div class="domain-zone"><?php echo $domain['zone']; ?></div>
                        <div class="domain-price"><?php echo $domain['price']; ?> грн</div>
                        <?php if ($domain['old_price']): ?>
                        <div class="domain-old-price"><?php echo $domain['old_price']; ?> грн</div>
                        <?php endif; ?>
                        <div class="domain-period">за рік</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="/pages/domains/register.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-search"></i>
                        Перевірити домен
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section class="news-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Останні новини</h2>
                    <p class="section-subtitle">Будьте в курсі всіх подій StormHosting</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($latest_news as $news): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-image">
                            <div class="news-category"><?php echo $news['category']; ?></div>
                        </div>
                        <div class="news-content">
                            <h3 class="news-title"><?php echo $news['title']; ?></h3>
                            <p class="news-excerpt"><?php echo $news['excerpt']; ?></p>
                            <div class="news-date">
                                <i class="bi bi-calendar-event"></i>
                                <?php echo date('d.m.Y', strtotime($news['date'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="quick-actions">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Швидкі дії</h2>
                    <p class="section-subtitle">Популярні інструменти та сервіси</p>
                </div>
            </div>
            <div