<?php
use Undefined\Stash\Controller\MainController;

/**
 * The Controller for displaying all pages
 *
 * @package  WordPress
 * @subpackage  Stash
 * @since    Stash 0.1
 */
class HomeController extends MainController
{
    protected $context;

    function __construct($context)
    {
        $this->templates = ['home.twig', 'front-page.twig', 'page.twig', 'index.twig'];
        $this->context = $context;

        parent::home();
        parent::render();
    }

    /**
     * This method is called when home is a static page
     */
    function staticPage()
    {
        $this->context['title'] = "Home: " . $this->context['post']->title;
        $this->templates = array('home.twig', 'front-page.twig', 'page.twig', 'index.twig');
    }

    /**
     * This method is called when home is a static page
     */
    function blogPage()
    {
        $this->context['title'] = "Home: Blog posts";
        $this->templates = array('archive.twig', 'index.twig');
    }
}