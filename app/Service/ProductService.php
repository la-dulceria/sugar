<?php


namespace App\Service;


use App\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;

class ProductService
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function create(string $name, string $description, float $price, string $category_id)
    {
        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

       $category = $this->categoryRepository->findOrfail($category_id);
       $product->category()->associate($category);

       $this->productRepository->save($product);
    }

    public function delete($id)
    {
        $product = $this->productRepository->findOrfail($id);

        $this->productRepository->delete($product);
    }

    public function edit (string $id, string $name, string $description,
                          float $price, string $categoryId)
    {
        $product = $this->productRepository->findOrfail($id);


        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

        $category = $this->categoryRepository->findOrfail($categoryId);

        $product->category()->associate($category);

        $this->productRepository->save($product);
    }



}
