<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{

    /**
     * List all post for admins
     *
     * @Route("/admin/post/list", name="admin_list_post")
     */
    public function listAction(Request $request)
    {
        return $this->render(
            'admin/list.html.twig',
            [
                'posts'      => $this->get('app.blog_post_manager')->getAll(),
            ]
        );
    }
}

