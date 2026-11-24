<?php
declare(strict_types=1);

namespace Requests;

class LibroRequest{
    private array $datos;
    private array $errores;

    function __construct(array $entrada, array $archivo){
        $this->sanear($entrada,$archivo);
        $this->validar();
    }

    public function datos(): array{
        return $this->datos;
    }

    public function errores(): array{
        return $this->errores;
    }

    private function sanear(array $entrada, array $archivo): void{
        $this->datos = [
            'titulo' => trim($entrada['titulo'] ?? ''),
            'autor' => trim($entrada['autor'] ?? ''),
            'genero' => trim($entrada['genero'] ?? ''),
            'anio' => (int) trim($entrada['anio'] ?? ''),
            'paginas' => (int) trim($entrada['paginas'] ?? ''),
            'portada' => $archivo,
        ];
    }

    private function validar(): void{
        $d = $this->datos;

        if($d['titulo'] === '')
            $this->errores['titulo'] = "El titulo no puede estar vacío";
        elseif(mb_strlen($d['titulo']) < 2)
            $this->errores['titulo'] = "El titulo debe tener 2 caracteres o más";
        elseif(mb_strlen($d['titulo']) > 80)
            $this->errores['titulo'] = "El titulo no puede tener más de 80 caracteres";
        elseif(!preg_match('/^[\pL\s\-\'\.]+$/u',$d['titulo']))
            $this->errores['titulo'] = "El titulo solo puede tener letras, espacios, guiones y puntos";

        if($d['autor'] === '')
            $this->errores['autor'] = "El autor no puede estar vacío";
        elseif(mb_strlen($d['autor']) < 4)
            $this->errores['autor'] = "El autor debe tener 4 caracteres o más";
        elseif(mb_strlen($d['autor']) > 50)
            $this->errores['autor'] = "El autor no puede tener más de 80 caracteres";
        elseif(!preg_match('/^[ñáéíóúÁÉÍÓÚ\pL\s]+$/u',$d['autor']))
            $this->errores['autor'] = "El autor solo puede tener letras, tíldes y espacios";   
        
        if($d['genero'] === '')
            $this->errores['genero'] = "El genero no puede estar vacío";
        elseif(!in_array($d['genero'],GENEROS))
            $this->errores['genero'] = "El genero debe pertenecer a la lista";

        if($d['anio'] === '')
            $this->errores['anio'] = "El año no puede estar vacío";
        elseif(!preg_match('[0-9]',$d['anio']))
            $this->errores['anio'] = "El año debe ser un numero";
        elseif($d['anio'] <= 0)
            $this->errores['anio'] = "El año del libro debe ser mayor a cero";

        if($d['paginas'] === '')
            $this->errores['paginas'] = "El número de páginas no puede estar vacío";
        elseif(!preg_match('[0-9]',$d['paginas']))
            $this->errores['paginas'] = "El número de páginas debe ser un numero";
        elseif($d['paginas'] <= 0)
            $this->errores['paginas'] = "El número de páginas debe ser mayor a cero";
    }

    public function esValido(): bool{
        return $this->errores === [];
    }
}