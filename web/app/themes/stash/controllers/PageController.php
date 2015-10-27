<?php
use Undefined\Stash\Controller\MainController;

/**
 * The Controller for displaying all pages
 *
 * @package  WordPress
 * @subpackage  Stash
 * @since    Stash 0.1
 */
class PageController extends MainController
{
    /**
     * Here you can map your Id's to a specific function in this file
     *
     * @var array
     */
    protected $mapping = [
        "733" => "about"
    ];

    protected $context;

    function __construct($context)
    {
        $this->context = $context;
        $this->templates = ['page-' . $this->context['post']->post_name . '.twig', 'page.twig'];

        parent::map();
        parent::render();
    }

    /**
     * This is the function that is mapped to the id 733
     */
    protected function about()
    {
        $this->context['title'] = "About";
        $this->templates = ['page-about.twig'];
    }
}