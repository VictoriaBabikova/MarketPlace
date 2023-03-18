<?php
namespace App\Controller\Payment;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="app_payment")
    */
    public function paymentpage()
    {
        return $this->render('payment/payment.html.twig');
    }

    /**
     * @Route("/payment-progress", name="app_paymentprogress")
    */
    public function paymentProgresspage()
    {
        return $this->render('payment/paymentprogress.html.twig');
    }

    /**
     * @Route("/payment-someone", name="app_paymentsomeone")
    */
    public function paymentSomeonepage()
    {
        return $this->render('payment/paymentsomeone.html.twig');
    }
}
