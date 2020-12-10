<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repository\CategoryRepository;


use App\Repository\ProductRepository;
use App\Service\CategoryService;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function new(CategoryRepository $categoryRepository)
    {
        return view('admin/products/new', [
            'categorys' => $categoryRepository->all()]);
    }

    public function create(Request $request, ProductService $service,
                           CategoryRepository $categoryRepository)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $service->create(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('category_id')
        );

        $request->session()->flash('alert-success', 'Producto cread con exito');

        return view('admin/products/new', [
            'categorys' => $categoryRepository->all()]);
    }

    public function index(ProductRepository $productRepository)
    {
        return view('admin/products/index', [
            'products' => $productRepository->all()]);
    }

    public function delete($id, ProductService $service,
                           ProductRepository $productRepository)
    {
        $service->delete($id);

        return view('admin/products/index', [
            'products' => $productRepository->all()]);
    }

    public function edit(CategoryRepository $categoryRepository,
                         ProductRepository $productRepository, string $id)
    {
        return view('admin/products/edit', [
            'categorys' => $categoryRepository->all(),
            'products' => $productRepository->findOrfail($id)
        ]);
    }

    public function update(string $id, Request $request,
                           ProductService $service, ProductRepository $productRepository)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id'=>'required'
        ]);

        $service->edit(
            $id,
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('category_id')

        );

        $request->session()->flash('alert-success', 'Producto editado');

        return view('admin/products/index', [
            'products' => $productRepository->all()]);
    }

    public function autoComplete(Request $request, ProductRepository $productRepository)
    {
        $product = Product::select("name")
            ->where('name','like',"%{$request->terms}%")
            ->get();

        return response()->json($product);

    }

    public function findProduct(Request $request, ProductRepository $productRepository)
    {
        $find = $request->input('find');

        return view('admin/products/index', ['products'=> $productRepository->where($find)]);

    }

}
