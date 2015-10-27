<?php
use Undefined\Stash\Controller\MainController;

/**
 * The Controller for displaying all pages
 *
 * @package  WordPress
 * @subpackage  Stash
 * @since    Stash 0.1
 */
class SingleController extends MainController
{
    protected $context;

    function __construct($context)
    {
        $this->context = $context;
        $this->context['title'] = $this->context['post']->title;
        $this->templates = ['single-' . $this->context['post']->ID . '.twig', 'single-' . $this->context['post']->post_type . '.twig', $this->context['post']->slug . '.twig', 'single.twig', 'index.twig'];

        parent::singles();
        parent::render();
    }

    /**
     * This method is called when the post type is equal to "post"
     */
    function post()
    {
        $this->context['title'] = "Blog post: " . $this->context['post']->title;
        $this->templates = ['single.twig'];
    }
}