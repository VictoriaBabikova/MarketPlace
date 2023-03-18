<?php
namespace App\Controller;

use App\Repository\BannerRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(BannerRepository $bannerRepository)
    {
        $banners = $bannerRepository->findActiveBanners();
        $rendomActiveBanner = [];
        for ($i=0; $i < 3; $i++) {
            $rendomActiveBanner[] = $banners[rand(0, count($banners)-1)];
        }
        
        //dd($rendomActiveBanner);
        return $this->render('index.html.twig', [
            'banners' => $rendomActiveBanner,
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
    public function catalogpage(Request $request, ProductRepository $productRepository)
    {
        $products = $productRepository->findByProducts($request->request->get('category'));
        //dd($products);
        return $this->render('catalog.html.twig', [
            'products' => $products
        ]);
    }
}
