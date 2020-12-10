<?php


namespace App\Repository;


use App\Product;
use http\Env\Request;

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
}
