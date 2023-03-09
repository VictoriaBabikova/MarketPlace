<?php
namespace App\Controller\Product;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    /**
     * @Route("/compare", name="app_compare")
     */
    public function comparepage()
    {
        return $this->render('compare.html.twig');
    }

    /**
     * @Route("/cart", name="app_cart")
     */
    public function cartpage()
    {
        return $this->render('cart.html.twig');
    }

    /**
     * @Route("/shop", name="app_shop")
     */
    public function shoppage()
    {
        return $this->render('shop.html.twig');
    }

    /**
     * @Route("/product", name="app_product")
    */
    public function productpage()
    {
        return $this->render('product.html.twig');
    }

    /**
     * @Route("/account", name="app_account")
    */
    public function accountpage()
    {
        return $this->render('account.html.twig');
    }
}
