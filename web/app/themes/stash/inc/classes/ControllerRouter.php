<?php
namespace Undefined\Stash\Controller;

/**
 * The class that routes from Wordpress Template hierarchy to the controllers
 *
 * @package  WordPress
 * @subpackage  Stash
 * @since    Stash 0.1
 */

use Timber;

class ControllerRouter
{
    private $context;
    private $include;
    private $controller;
    private $conditional;

    function initialize()
    {
        $this->setContext();

        $this->isHome();
        $this->isSingular();
        $this->isPaged();

        $this->is404();
        $this->isSearch();

        $this->tryToInclude($this->conditional);
    }

    private function isHome()
    {
        if (is_front_page() || is_home()) {
            $this->conditional = "Home";
        }
    }

    private function isSingular()
    {
        if (is_singular()) {
            $this->isPage();
            $this->isSingle();
        }
    }

    private function isPage()
    {
        if (is_page()) {
            $this->conditional = "Page";
        }
    }

    private function is404()
    {
        if (is_404()) {
            $this->conditional = "FourOFour";
        }
    }

    private function isSearch()
    {
        if (is_search()) {
            $this->tryToInclude('search');
            $this->tryToInclude('archive');
        }
    }

    private function isSingle()
    {
        if (is_single()) {
            $this->conditional = "Single";
        }
    }

    private function isPaged()
    {
        if (is_archive()) {
            $this->conditional = "Archive";
        }
    }

    private function tryToInclude($className)
    {
        var_dump($className);
        if ($this->classExists($className)) {
            $this->setIncludeAndContext($className);
        }
    }

    private function classExists($className)
    {
        $name = $className . 'Controller';

        return class_exists($name) ? true : false;
    }

    private function setIncludeAndContext($className)
    {
        if (!$this->include) {
            $this->include = true;
            $name = $className . 'Controller';
            $this->controller = new $name($this->context);
        }
    }

    private function setContext()
    {
        $this->context = Timber::get_context();

        if (is_singular()) {
            $this->context['post'] = Timber::get_post();
            unset($this->context['posts']);
        } else {
            $this->context['posts'] = Timber::get_posts();
        }
    }
}