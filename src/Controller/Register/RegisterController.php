<?php
namespace App\Controller\Register;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login()
    {
        return $this->render('register/login.html.twig');
    }

    /**
     * @Route("/registration", name="app_register")
     */
    public function registration()
    {
        return $this->render('register/register.html.twig');
    }
}
