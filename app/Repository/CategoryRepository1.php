<?php


namespace App\Repository;


use App\Category;

class CategoryRepository1
{
    public function save (Category $category)
    {
        $category->save();
    }

    public function all()
    {
        return Category::all();
    }

    public function findOrfail($id)
    {
        return Category::findOrfail($id);
    }

    public function delete(Category $category)
    {
        $category->delete();
    }

}
