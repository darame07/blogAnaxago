<?php

namespace AppBundle\Manager;

use AppBundle\Entity\BlogPost;
use AppBundle\Repository\BlogPostRepository;


/**
 * Class BlogPostManager
 *
 * @package AppBundle\Manager
 */
class BlogPostManager
{
    /** @var BlogPostRepository */
    private $blogPostRepository;

    /**
     * BlogPostManager constructor.
     *
     * @param BlogPostRepository $blogPostRepository
     */
    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * @param BlogPost $blogPost
     */
    public function save(BlogPost $blogPost)
    {
        $this->blogPostRepository->save($blogPost);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->blogPostRepository->findBy([], ['createdAt' => 'DESC']);
    }

    /**
     * @param $id
     *
     * @return object
     */
    public function get($id)
    {
        return $this->blogPostRepository->find($id);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        /** @var BlogPost $blogPost */
        $blogPost = $this->get($id);

        return $this->blogPostRepository->remove($blogPost);
    }
}