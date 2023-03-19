<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Seller;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SellerFixtures extends Fixture
{
    /**
    *  @var \Faker\Generator
    */
    protected $faker;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $product = $this->productRepository->findAllProducts();
        
        for ($i=0; $i < 1000; $i++) {
            $rand_productKey = array_rand($product);
            $seller = new Seller(); // loading sellers

            $seller
                ->setName($this->faker->company)
                ->setPhone($this->faker->phoneNumber)
                ->setAddress($this->faker->address)
                ->setEmail($this->faker->companyEmail)
                ->setDescription($this->faker->text(200))
                ->setDiscount($this->faker->numberBetween($min = 5, $max = 70))
                ->addProduct($product[$rand_productKey])
                ;

            $manager->persist($seller);
            $manager->flush();
        }
    }
}
