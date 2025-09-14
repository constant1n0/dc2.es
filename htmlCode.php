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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>.container-slim{max-width:1120px}</style>
</head>
    <?php
}


function loadNav() : void {
    ?>

    <?php
}