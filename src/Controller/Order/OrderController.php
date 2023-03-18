<?php
namespace App\Controller\Order;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
    */
    public function orderpage()
    {
        return $this->render('order/order.html.twig');
    }

    /**
     * @Route("/one-order", name="app_oneorder")
    */
    public function oneOrderpage()
    {
        return $this->render('order/oneorder.html.twig');
    }
}
