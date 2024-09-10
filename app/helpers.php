<?php

namespace App;

use App\Http\Response;

class Helpers
{
    public static function view($view, $data = [])
    {
        return new Response($view, $data);
    }

    public static function viewPath($view)
    {
        return __DIR__ . "/../app/http/views/$view.php";
    }
}
