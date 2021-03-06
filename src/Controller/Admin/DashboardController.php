<?php

namespace Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('admin/dashboard.html.twig', []);
    }
}
