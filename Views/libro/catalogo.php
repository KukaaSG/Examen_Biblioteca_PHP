<h1>Catálogo</h1>

<?php
// TODO (apartado 3): recibe la variable $libros (array de objetos Libro).
// Recórrela y pinta cada ficha reutilizando imprimeFicha.php.
// Si no hay libros, muestra «Todavía no hay libros en la biblioteca».
use Core\Pages;

foreach($libros as $libro){
    new Pages()->render('libro/imprimeFicha', ['libro' => $libro]);
}
?>
