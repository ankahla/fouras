<?php

namespace Infrastructure\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    #[Route(path: '/admin', name: 'admin_dashboard')]
    public function index(Request $request)
    {
        return $this->render('admin/dashboard.html.twig', []);
    }
}
