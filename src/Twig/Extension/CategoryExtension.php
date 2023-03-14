<?php

namespace App\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\AbstractExtension;
use App\Repository\CategoryRepository;
use App\Twig\Runtime\CategoryExtensionRuntime;

class CategoryExtension extends AbstractExtension implements GlobalsInterface
{
    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    // public function getFilters(): array
    // {
    //     return [
    //         // If your filter generates SAFE HTML, you should add a third
    //         // parameter: ['is_safe' => ['html']]
    //         // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
    //         new TwigFilter('filter_name', [CategoryExtensionRuntime::class, 'doSomething']),
    //     ];
    // }

    // public function getFunctions(): array
    // {
    //     return [
    //         new TwigFunction('categories', [CategoryExtensionRuntime::class, 'getActiveCategory']),
    //     ];
    // }

    public function getGlobals(): array
    {
        $categories = $this->categoryRepository->findByActiveCategory();
        
        return [
          'categories' => $categories
        ];
    }
}
