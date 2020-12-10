<?php


namespace App\Service;

use App\Category;

use App\Repository\CategoryRepository;
use Illuminate\Validation\ValidationException;


class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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

        $this->categoryRepository->delete($category);
    }

    public function edit (string $id, string $name)
    {
        $category = $this->categoryRepository->findOrfail($id);

        $category->SetName($name);

        $this->categoryRepository->save($category);
    }




}
