<?php


namespace App\Service;

use App\Category;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Validation\ValidationException;


class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    private $productRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }


    public function create(string $name)
    {
        $category = new Category();
        $category->SetName($name);

        $this->categoryRepository->save($category);
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->findOrfail($id);

        $productCategory = $this->productRepository->findByCategory($category);

        if (!empty($productCategory->toArray())) {
            throw ValidationException::withMessages(['category' => 'No se puede eliminar porque existen productos con la categoría']);
        }

        $this->categoryRepository->delete($category);

    }

    public function edit (string $id, string $name)
    {
        $category = $this->categoryRepository->findOrfail($id);

        $category->SetName($name);

        $this->categoryRepository->save($category);
    }




}
