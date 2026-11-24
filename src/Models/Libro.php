<?php
declare(strict_types=1);

namespace Models;

class Libro{
    function __construct(
        public readonly string $titulo,
        public readonly string $autor,
        public readonly string $genero,
        public readonly int $anio,
        public readonly int $paginas,
        public readonly string $portada
    ){}

    function existe(): bool{
        $f = fopen(RUTA_BIBLIOTECA,'r',);

        while(($linea = fgets($f)) !== false){
            $libro = json_decode($linea,true);
            $tituloFichero = mb_strtolower(trim($libro['titulo']));
            $autorFichero = mb_strtolower(trim($libro['autor']));

            if($tituloFichero === $this->titulo && $autorFichero !== $this->autor )
                return true;
        }
        fclose(RUTA_BIBLIOTECA);
        return false;
    }

    function guardar(): bool{
        $libroJson = json_encode($this,JSON_UNESCAPED_UNICODE);

        //$f = fopen(RUTA_BIBLIOTECA,'a');
        return file_put_contents(RUTA_BIBLIOTECA,$libroJson);
    }
}