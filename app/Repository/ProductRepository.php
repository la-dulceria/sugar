<?php


namespace App\Repository;


use App\Category;
use App\Product;


class ProductRepository
{
    public function save(Product $product)
    {
        $product->save();
    }

    public function all()
    {
        return Product::all();
    }

    public function findOrfail($id)
    {
        return Product::findOrfail($id);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function where ($find)
    {
        return Product::where('name','LIKE' ,"%$find%")->get();
    }

    public function findByCategory( Category $category)
    {
        return Product::where('category_id', '=' , $category->getId())->get();
    }
}
