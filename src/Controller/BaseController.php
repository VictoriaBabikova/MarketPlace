<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/contacts", name="app_contact")
     */
    public function contactspage()
    {
        return $this->render('contacts.html.twig');
    }

    /**
     * @Route("/about", name="app_about")
     */
    public function aboutpage()
    {
        return $this->render('about.html.twig');
    }

    /**
     * @Route("/sales", name="app_sale")
    */
    public function salespage()
    {
        return $this->render('sale.html.twig');
    }

    /**
     * @Route("/catalog", name="app_catalog")
    */
    public function catalogpage()
    {
        return $this->render('catalog.html.twig');
    }
}
