<?php
use Undefined\Stash\Controller\MainController;

/**
 * The Controller for displaying all pages
 *
 * @package  WordPress
 * @subpackage  Stash
 * @since    Stash 0.1
 */
class ArchiveController extends MainController
{
    protected $context;
    protected $postType;
    protected $postTypeName;

    function __construct($context)
    {
        $this->setContext($context);

        $this->context['title'] = "Archive: " . $this->postTypeName;
        $this->templates = ['archive-' . $this->postType . '.twig', 'archive.twig'];

        parent::archive();
        parent::render();
    }

    function setContext($context)
    {
        $this->context = $context;
        $postType = get_queried_object();

        $this->postType = isset($postType->slug) ? $postType->slug : $postType->rewrite['slug'];
        $this->postTypeName = isset($postType->name) ? $postType->name : $postType->labels->name;
    }

    /**
     * This method is called when the post type is equal to "example"
     * or if is category or tag archive is equal to "example"
     */
    function Example()
    {
        $this->context['title'] = "Example Post Archive Page";
        $this->templates = ['archive-example.twig'];
    }
}