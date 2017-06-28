<?php

namespace AppBundle\Repository;

use AppBundle\Entity\BlogPost;

/**
 * Class BlogPostRepository
 *
 * @package ApiBundle\Repository
 */
class BlogPostRepository extends \Doctrine\ORM\EntityRepository
{
    public function save(BlogPost $blogPost)
    {
        $this->getEntityManager()->persist($blogPost);
        $this->getEntityManager()->flush();
    }

    public function remove(BlogPost $blogPost)
    {
        $this->getEntityManager()->remove($blogPost);
        $this->getEntityManager()->flush();
    }
}
