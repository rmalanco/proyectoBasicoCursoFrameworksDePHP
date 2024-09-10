<?php

namespace App\Http\Controllers;

use App\Helpers;

class HomeController
{
    public function index()
    {
        return Helpers::view('home/index', [
            'title' => 'Curso de Introducción a Frameworks de PHP',
            'subtitle' => 'Aprende a programar desde cero',
            'description' => 'En este curso aprenderás a programar desde cero con PHP, el lenguaje de programación más popular en la web.'
        ]);
    }
}