<?php
namespace App\Controller\Profile;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
    */
    public function profilepage()
    {
        return $this->render('profile/profile.html.twig');
    }

    /**
     * @Route("/profile-avatar", name="app_profileAvatar")
    */
    public function profileAvatarpage()
    {
        return $this->render('profile/profileAvatar.html.twig');
    }
}
