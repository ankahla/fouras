<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VendorController extends Controller
{
    /**
     * @Route("/vendors", name="vendors")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle::Vendor/categories.html.twig');
    }

    /**
     * @Route("/vendor_profile", name="vendor_profile")
     */
    public function profileAction()
    {
        return $this->render('FrontBundle::Vendor/profile.html.twig');
    }

    /**
     * @Route("/vendor_search", name="vendor_search")
     */
    public function searchAction()
    {
        return $this->render('FrontBundle::Vendor/search.html.twig');
    }

    /**
     * @Route("/vendor_dashboard", name="vendor_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/vendor_edit_profile", name="vendor_edit_profile")
     */
    public function editProfileAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/profile.html.twig');
    }

    /**
     * @Route("/vendor_services", name="vendor_services")
     */
    public function ServicesAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/services.html.twig');
    }

    /**
     * @Route("/vendor_add_service", name="vendor_add_service")
     */
    public function AddServiceAction()
    {
        return $this->render('FrontBundle::Vendor/Dashboard/serviceForm.html.twig');
    }
}
