<?php
namespace App\Controller\Product;

use DateTime;
use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function shoppage(Request $request, SellerRepository $sellerrepository)
    {
        $seller = $sellerrepository->findOneSeller(htmlspecialchars(trim($request->query->get('seller'))));
        //dd($seller);
        return $this->render('shop.html.twig', [
            'seller' => $seller
        ]);
    }

    /**
     * @Route("/product", name="app_product")
    */
    public function productpage(
        Request $request,
        ProductRepository $productRepository,
        EntityManagerInterface $manager,
        FeedbackRepository $feedbackRepository
    ) {
        $product = $productRepository->findProduct($request->get('prodId'));

        $date = new DateTime();
        $feedbacks = $feedbackRepository->findAllFeedbacksProductId($product->getId());

        if ($request->request->get('name')) {
            $feedback = new Feedback();
            $feedback
                ->setName(htmlspecialchars(trim($request->request->get('name'))))
                ->setBody(htmlspecialchars(trim($request->request->get('review'))))
                ->setEmail(htmlspecialchars(trim($request->request->get('email'))))
                ->setCreatedAt($date)
                ->setProduct($product)
            ;
            $manager->persist($feedback);
            $manager->flush($feedback);

            return $this->redirectToRoute('app_product', ['prodId' => $product->getId()]);
        }

        return $this->render('product.html.twig', [
            'product' => $product,
            'feedbacks' => $feedbacks,
        ]);
    }

    /**
     * @Route("/account", name="app_account")
    */
    public function accountpage(Request $request, UserRepository $userRepository)
    {
        $phone  = $request->query->get('phone');
        $user = $userRepository->findByPhone($phone);
        return $this->render('account.html.twig', [
            'user' => $user,
        ]);
    }
}
