<?php
namespace Undefined\Stash\Controller;

use Timber;

class MainController
{
    public function render()
    {
        Timber::render($this->templates, $this->context);
    }

    public function map()
    {
        foreach ($this->mapping as $key => $map) {
            if (($this->context['post']->ID == $key) && function_exists($this->$map())) {
                $this->$map();
            }

            if (function_exists('pll_get_post')) {
                if (($this->context['post']->ID == pll_get_post($key)) && function_exists($this->$map())) {
                    $this->$map();
                }
            }
        }
    }

    public function singles()
    {
        $this->tryMethod($this->context['post']->post_type);
    }

    public function archive()
    {
        $this->tryMethod($this->postType);
    }

    protected function tryMethod($methodName)
    {
        if (method_exists($this, $methodName)) {
            $this->$methodName();
        }
    }

    public function home()
    {
        if (is_front_page() && is_home()) {
            $this->blogPage();
        } elseif (is_front_page()) {
            $this->staticPage();
        } elseif (is_home()) {
            $this->staticPage();
        }
    }
}

