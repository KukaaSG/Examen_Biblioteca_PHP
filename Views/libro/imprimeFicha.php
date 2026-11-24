<?php
// TODO (apartado 2): vista de la ficha de un libro.
// Recibe la variable $libro (objeto Libro). Solo HTML y PHP para pintar.
?>
<article class="ficha">
    <img src=<?= e($libro['portada'])  ?>>
    <h3><?= e($libro['titulo']) ?></h3>
    <p class="autor"><?= e($libro['autor']) ?></p>
    <span class="genero"><?= e($libro['genero'])  ?></span>
</article>