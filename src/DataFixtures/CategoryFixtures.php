<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Banner;
use App\Entity\Seller;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\SubCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
     /**
     *  @var \Faker\Generator
     */
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        $arrayCategory = [
            "Accessories" => "build/images/icons/departments/1.svg",
            "Bags" => "build/images/icons/departments/2.svg",
            "Cameras" => "build/images/icons/departments/3.svg",
            "Clothings" => "build/images/icons/departments/4.svg",
            "Electronics" => "build/images/icons/departments/5.svg",
            "Fashion" => "build/images/icons/departments/6.svg",
            "Furniture" => "build/images/icons/departments/7.svg",
            "Lightings" => "build/images/icons/departments/8.svg",
            "Mobiles" => "build/images/icons/departments/9.svg",
            "Trends" => "build/images/icons/departments/10.svg",
            "More" => "build/images/icons/departments/11.svg",
            "Lightings" => "build/images/icons/departments/8.svg",
        ];

        $arraySubCategory = [
            "Accessories" => "build/images/icons/departments/1.svg",
            "Bags" => "build/images/icons/departments/2.svg"
        ];

        foreach ($arrayCategory as $key => $value) {
            $category = new Category(); // loading category
                $category
                ->setCategory($key)
                ->setImagepath($value)
                ->setActive(true)
            ;
            
            if ($category->getCategory() == "Cameras") {
                foreach ($arraySubCategory as $key_2 => $value_2) {
                    $subcategory = new SubCategory();
                    $subcategory
                        ->setCategory($category)
                        ->setSubcategory($key_2)
                        ->setImagepath($value_2)
                        ->setActive(true)
                    ;
                    $manager->persist($subcategory);
                }
            }
            if ($category->getCategory() == "More") {
                foreach ($arraySubCategory as $key_2 => $value_2) {
                    $subcategory = new SubCategory();
                    $subcategory
                        ->setCategory($category)
                        ->setSubcategory($key_2)
                        ->setImagepath($value_2)
                        ->setActive(true)
                    ;
                    $manager->persist($subcategory);
                }
            }
            for ($i=0; $i < 10; $i++) {
                $product = new Product; //loading product
                $product
                ->setCategory($category)
                ->setProductname($this->faker->sentence($nbWords = 3, $variableNbWords = true))
                ->setPricein($this->faker->randomFloat($nbMaxDecimals = 2, $min = 200, $max = 500))
                ->setPricesale($product->getPricein()- $this->faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 200))
                ->setInfo($this->faker->text(150))
                ->setImagepath('build/images/content/home/bigGoods.png')
                ->setSpecifications($this->faker->paragraph($nbSentences = 3, $variableNbSentences = true))
                ;

                $banner = new Banner; // loading banner
                $banner
                    ->setBannername($product->getProductname())
                    ->setBannerinfo($product->getInfo())
                    ->setImagepath($product->getImagepath())
                    ->setActive($this->faker->boolean(50))
                    ->setProduct($product)
                ;

                $manager->persist($banner);

                $manager->persist($product);
            }
            $manager->persist($category);
        }
        $manager->flush();
    }
}
