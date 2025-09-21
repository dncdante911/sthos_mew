</main>
    
    <style>
        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
        }
        
        body {
    margin: 0;
    padding: 0;
}

/* Скрываем возможные стрелки навигации или debug элементы */
.arrow-up,
.arrow-down,
.scroll-indicator,
.back-to-top,
.floating-arrow {
    display: none !important;
}

/* Убираем возможные margin/padding снизу страницы */
html, body {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}
        
        .footer {
            background: #343a40;
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: white;
        }
    </style>
    <!-- Footer -->
   <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">StormHosting UA</h5>
                <p>Надійний хостинг провайдер для вашого онлайн бізнесу. Ми забезпечуємо стабільну роботу ваших сайтів 24/7.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-light"><i class="bi bi-telegram fs-4"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter fs-4"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">Послуги</h6>
                <ul class="list-unstyled">
                    <li><a href="/hosting">Хостинг</a></li>
                    <li><a href="/vds">VDS/VPS</a></li>
                    <li><a href="/domains">Домени</a></li>
                    <li><a href="#">SSL сертифікати</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">Підтримка</h6>
                <ul class="list-unstyled">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="/contacts">Контакти</a></li>
                    <li><a href="#">Документація</a></li>
                    <li><a href="#">Статус серверів</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 mb-4">
                <h6 class="fw-bold mb-3">Контакти</h6>
                <div class="d-flex mb-2">
                    <i class="bi bi-geo-alt me-2"></i>
                    <span>Україна, Дніпро</span>
                </div>
                <div class="d-flex mb-2">
                    <i class="bi bi-envelope me-2"></i>
                    <span>info@sthost.pro</span>
                </div>
                <div class="d-flex mb-2">
                    <i class="bi bi-telephone me-2"></i>
                    <span>+380 XX XXX XX XX</span>
                </div>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> StormHosting UA. Всі права захищені.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <small class="text-muted">Розроблено з ❤️ в Україні</small>
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
    

<!-- Простой чат - добавьте в footer.php -->
<style>
.simple-chat-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    border: none;
    color: white;
    cursor: pointer;
    z-index: 9999;
    font-size: 24px;
}
.simple-chat-window {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    height: 500px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    display: none;
    flex-direction: column;
    z-index: 9999;
}
.chat-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 20px;
    border-radius: 20px 20px 0 0;
    text-align: center;
}
.chat-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #f8fafc;
}
.chat-input {
    padding: 20px;
    border-top: 1px solid #eee;
    display: flex;
    gap: 10px;
}
.chat-input input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
}
.chat-input button {
    background: #667eea;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
}
.message {
    margin-bottom: 15px;
    padding: 10px 15px;
    border-radius: 15px;
    max-width: 80%;
}
.user-msg {
    background: #667eea;
    color: white;
    margin-left: auto;
}
.bot-msg {
    background: white;
    border: 1px solid #eee;
}
</style>

<button class="simple-chat-btn" onclick="toggleSimpleChat()" id="chatBtn">💬</button>

<div class="simple-chat-window" id="chatWindow">
    <div class="chat-header">
        <h4>Техподдержка StormHosting</h4>
        <button onclick="toggleSimpleChat()" style="background: none; border: none; color: white; float: right; cursor: pointer;">×</button>
    </div>
    <div class="chat-messages" id="chatMessages">
        <div class="message bot-msg">Привет! Чем могу помочь?</div>
    </div>
    <div class="chat-input">
        <input type="text" id="chatInput" placeholder="Напишите сообщение..." onkeypress="if(event.key==='Enter') sendSimpleMessage()">
        <button onclick="sendSimpleMessage()">Отправить</button>
    </div>
</div>



<script>
function toggleSimpleChat() {
    const window = document.getElementById('chatWindow');
    const isVisible = window.style.display === 'flex';
    window.style.display = isVisible ? 'none' : 'flex';
}

function sendSimpleMessage() {
    const input = document.getElementById('chatInput');
    const messages = document.getElementById('chatMessages');
    const text = input.value.trim();
    
    if (!text) return;
    
    // Добавляем сообщение пользователя
    const userMsg = document.createElement('div');
    userMsg.className = 'message user-msg';
    userMsg.textContent = text;
    messages.appendChild(userMsg);
    
    input.value = '';
    
    // Проверяем ключевые слова для подключения оператора
    const lowerText = text.toLowerCase();
    const operatorKeywords = ['оператор', 'техподдержка', 'тех поддержка', 'живой человек', 'человек', 'специалист', 'менеджер', 'помощь специалиста', 'связаться с оператором'];
    const needOperator = operatorKeywords.some(keyword => lowerText.includes(keyword));
    
    // Простые автоответы
    setTimeout(() => {
        const botMsg = document.createElement('div');
        botMsg.className = 'message bot-msg';
        
        if (needOperator) {
            botMsg.innerHTML = `
                <strong>Подключаю к оператору...</strong><br>
                Ваш запрос передан специалисту техподдержки.<br>
                <small>В рабочее время ответим в течение 5-10 минут.<br>
                Также можете позвонить: +380 99 623-96-37</small>
            `;
            
            // Специальное уведомление для техподдержки
            notifySupport(text, 'ЗАПРОС ОПЕРАТОРА', true);
            
        } else if (lowerText.includes('привет')) {
            botMsg.innerHTML = 'Привет! Чем могу помочь?<br><small>Напишите "оператор" для связи со специалистом</small>';
        } else if (lowerText.includes('хостинг')) {
            botMsg.innerHTML = 'По вопросам хостинга обращайтесь:<br>📧 support@sthost.pro<br>📞 +380 99 623-96-37<br><small>Или напишите "оператор" для прямой связи</small>';
        } else if (lowerText.includes('домен')) {
            botMsg.innerHTML = 'Вопросы по доменам:<br>📧 sales@sthost.pro<br>📞 +380 97 714-19-80<br><small>Или напишите "техподдержка" для связи со специалистом</small>';
        } else if (lowerText.includes('ssl')) {
            botMsg.innerHTML = 'SSL сертификаты устанавливаем бесплатно!<br>📧 ssl@sthost.pro<br><small>Для консультации напишите "оператор"</small>';
        } else if (lowerText.includes('проблема') || lowerText.includes('не работает') || lowerText.includes('ошибка')) {
            botMsg.innerHTML = `
                <strong>Понял, у вас техническая проблема.</strong><br>
                Для быстрого решения напишите "оператор" - подключу специалиста.<br>
                <small>Или опишите проблему подробнее</small>
            `;
        } else {
            botMsg.innerHTML = `
                Спасибо за сообщение!<br>
                📧 support@sthost.pro<br>
                📞 +380 99 623-96-37<br>
                <small>Для прямой связи напишите "оператор"</small>
            `;
        }
        
        messages.appendChild(botMsg);
        messages.scrollTop = messages.scrollHeight;
        
        // Обычное уведомление для всех сообщений
        if (!needOperator) {
            notifySupport(text, 'Новое сообщение в чате', false);
        }
        
    }, 1000);
    
    messages.scrollTop = messages.scrollHeight;
}

// Функция уведомления техподдержки
function notifySupport(message, subject, urgent) {
    const formData = new FormData();
    formData.append('message', message);
    formData.append('subject', subject);
    formData.append('urgent', urgent ? '1' : '0');
    formData.append('page', window.location.href);
    formData.append('time', new Date().toLocaleString('ru'));
    formData.append('user_agent', navigator.userAgent);
    
    fetch('/chat/notify-support.php', {
        method: 'POST',
        body: formData
    });
}

// Совместимость с существующими кнопками
window.openChat = toggleSimpleChat;
</script>



</body>
</html>

<?php
// Защита от прямого доступа
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}
?>