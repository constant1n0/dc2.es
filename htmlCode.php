<?php declare( strict_types = 1 );

/*

*/
function loadHTMLHead() : void {
    ?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DC2 — Natural Cosmeceuticals</title>
  <meta name="description" content="DC2 Natural Cosmeceuticals: fórmulas eficaces con activos de alto rendimiento. Descubre sérums, cremas y lociones con resultados visibles." />

  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Paleta inspirada en el logo adjunto
    tailwind.config = { theme: { extend: {
      colors: {
        ink: '#0b0f14',
        brand: {
          50:'#e6fffb',100:'#c8fff6',200:'#9cf7ea',300:'#6feee0',400:'#3fded2',
          500:'#14b8a6', // teal principal
          600:'#0ea5a4',700:'#0f766e',800:'#115e59',900:'#134e4a'
        },
        leaf: { 500:'#22c55e',700:'#15803d' },
      },
      fontFamily:{ sans:["Inter","system-ui","-apple-system","Segoe UI","Roboto","Ubuntu","Cantarell","Noto Sans","Helvetica Neue","Arial","sans-serif"]},
      boxShadow:{ soft:'0 12px 30px rgba(0,0,0,0.15)'}
    }}};
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
  <style>.container-slim{max-width:1120px}</style>
</head>
    <?php
}


function loadNav() : void {
    ?>

    <?php
}

function drawFooter() : void {
    ?>
  <footer class="border-t border-white/10">
    <div class="container container-slim mx-auto px-4 py-10 text-sm text-white/60">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <p>© <span id="year"></span> DC2 Natural Cosmeceuticals</p>
        <div class="flex items-center gap-4">
          <a class="hover:text-brand-400" href="#">Aviso legal</a>
          <a class="hover:text-brand-400" href="#">Privacidad</a>
          <a class="hover:text-brand-400" href="#">Cookies</a>
        </div>
      </div>
    </div>
  </footer>
    <?php
}

function contact() : void {
    ?>
  <section id="contacto" class="bg-white text-ink">
    <div class="container container-slim mx-auto px-4 py-16 md:py-20">
      <h2 class="text-3xl md:text-4xl font-extrabold">Contacto</h2>
      <p class="mt-3 text-ink/70">Distribución, prensa o compras. Te respondemos en 24–48h.</p>
      <form class="mt-8 grid md:grid-cols-2 gap-4 max-w-3xl" action="form_verify.php" method="POST">
        <input class="px-4 py-3 rounded-xl border border-ink/10" name="nombre" placeholder="Nombre" required>
        <input class="px-4 py-3 rounded-xl border border-ink/10" type="email" name="email" placeholder="Email" required>
        <input class="px-4 py-3 rounded-xl border border-ink/10 md:col-span-2" name="asunto" placeholder="Asunto" required>
        <textarea class="px-4 py-3 rounded-xl border border-ink/10 md:col-span-2" name="mensaje" rows="5" placeholder="Cuéntanos brevemente"></textarea>        <input type="hidden" name="ipClient" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
        <!-- reCAPTCHA v3 (invisible) -->
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        
        <!-- reCAPTCHA v2 (checkbox) - Elige una versión -->
        <!-- <div class="g-recaptcha md:col-span-2" data-sitekey="TU_SITE_KEY"></div> -->        
        <button class="mt-2 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-ink text-white font-semibold hover:opacity-90">Enviar</button>
      </form>
      <p class="mt-4 text-sm text-ink/60">O escríbenos: <a class="underline" href="mailto:info@dc2.es">info@dc2.es</a></p>
    </div>
  </section>
    <?php
}