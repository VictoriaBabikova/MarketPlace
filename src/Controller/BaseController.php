<?php
namespace App\Controller;

use App\Repository\BannerRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(BannerRepository $bannerRepository, ProductRepository $productRepository)
    {
        $banners = $bannerRepository->findActiveBanners();
        $products = $productRepository->findTopEightProducts();
        $rendomActiveBanner = [];
        for ($i=0; $i < 3; $i++) {
            $rendomActiveBanner[] = $banners[rand(0, count($banners)-1)];
        }
        
        return $this->render('index.html.twig', [
            'banners' => $rendomActiveBanner,
            'topProducts' => $products,
        ]);
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
    public function catalogpage(
        Request $request,
        ProductRepository $productRepository,
        PaginatorInterface $paginator
    ) {
        $category = $request->query->get('category');

        $pagination = $paginator->paginate(
            $productRepository->findByProductsQuery(
                $request->query->get('category'),
                $request->request->get('price'),
                $request->request->get('title'),
                $request->request->get('seller'),
                $request->request->get('feedbacksOnly'),
                $request->request->get('info'),
                $request->query->get('popular'),
                $request->query->get('priceSort'),
                $request->query->get('feedbacks'),
                $request->query->get('novelty')
            ), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        $product = $pagination->getItems();
        $max = null;
        $min =null;
        $countProduct = count($product);
        for ($i=0; $i < count($product); $i++) {
            if ($product[$i]->getPricein() > $max || $max === null) {
                $max = $product[$i]->getPricein();
            }
            if ($product[$i]->getPricein() < $min || $min === null) {
                $min = $product[$i]->getPricein();
            }
        }

        return $this->render('catalog.html.twig', [
            'pagination' => $pagination,
            'category' => $category,
            'maxPrice' => $max,
            'minPrice' => $min,
            'countProduct' => $countProduct,
        ]);
    }
}
