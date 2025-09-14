/* 
 * We must include the next line before load this one.
 *   <!-- Script para reCAPTCHA v3 -->
 *   <script src="https://www.google.com/recaptcha/api.js?render=TU_SITE_KEY"></script>
 */


grecaptcha.ready(function() {
  grecaptcha.execute('TU_SITE_KEY', {action: 'contact'}).then(function(token) {
    document.getElementById('recaptchaResponse').value = token;
  });
});
