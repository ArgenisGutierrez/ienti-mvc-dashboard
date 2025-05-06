<?php

namespace App\Controllers;

use App\Models\Categoria;
use Lib\Alert;

class CategoriaController extends Controller
{
    private $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
    }

    public function index()
    {
        return $this->view(
            'categorias',
            [
            ]
        );
    }
}
