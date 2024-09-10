<?php

namespace App\Http;

use App\Helpers;

class Response
{
    protected $view;
    protected $data = [];

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function send()
    {
        $view = $this->getView();
        $data = $this->data;

        $content = file_get_contents(Helpers::viewPath($view));

        foreach ($data as $key => $value) {
            $content = str_replace("{{ $key }}", $value, $content);
        }

        $this->layoutHeader();
        echo $content;
        $this->layoutFooter();
    }

    public function layoutHeader()
    {
        $this->layout('header');
    }

    public function layoutFooter()
    {
        $this->layout('footer');
    }

    public function layout($layout)
    {
        echo file_get_contents(Helpers::viewPath("layouts/$layout"));
    }
}
