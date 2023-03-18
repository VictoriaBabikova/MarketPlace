<?php
namespace App\Controller\Product;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function productpage(Request $request, ProductRepository $productRepository)
    {
        
        $product = $productRepository->findProduct($request->get('prodId'));
        return $this->render('product.html.twig', [
            'product' => $product[0],
        ]);
    }

    /**
     * @Route("/account", name="app_account")
    */
    public function accountpage()
    {
        return $this->render('account.html.twig');
    }
}
