<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * Add post
     *
     * @Route("/blog/post/add", name="add_post")
     */
    public function addAction(Request $request)
    {
        $blogPost = new BlogPost();
        $blogPost->setAuthorId($this->getUser()->getId());

        $form = $this->createForm('blog_post', $blogPost);
        if ($form->handleRequest($request)->isValid()) {
            $this->get('app.blog_post_manager')->save($blogPost);

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render(
            'blog/add.html.twig',
            [
                'blog_post_form' => $form->createView(),
            ]
        );
    }

    /**
     * Modify post if author or admin
     *
     * @Route("/blog/post/{id}/modify", name="modify_post")
     */
    public function modifyAction(Request $request, $id)
    {
        $blogPostManager = $this->get('app.blog_post_manager');

        /** @var BlogPost $blogPost */
        $blogPost = $blogPostManager->get($id);
        if (!$blogPost) {
            throw $this->createNotFoundException();
        }

        if (!$this->getUser()->hasRole("ROLE_ADMIN") && $blogPost->getAuthorId() != $this->getUser()->getId()) {
            throw new AccessDeniedException();
        }


        $form = $this->createForm('blog_post', $blogPost);
        if ($form->handleRequest($request)->isValid()) {

            $this->get('app.blog_post_manager')->save($blogPost);

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render(
            'blog/add.html.twig',
            [
                'blog_post_form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete post if author or admin
     *
     * @Route("/blog/post/{id}/delete", name="delete_post")
     */
    public function deleteAction(Request $request, $id)
    {
        $blogPostManager = $this->get('app.blog_post_manager');

        /** @var BlogPost $blogPost */
        $blogPost = $blogPostManager->get($id);
        if (!$blogPost) {
            throw $this->createNotFoundException();
        }

        if (!$this->getUser()->hasRole("ROLE_ADMIN") && $blogPost->getAuthorId() != $this->getUser()->getId()) {
            throw new AccessDeniedException();
        }

        $blogPostManager->delete($id);

        return $this->redirect($this->generateUrl('homepage'));
    }
}

