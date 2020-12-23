<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function new(CategoryRepository $categoryRepository)
    {
        return view('admin/products/new', [
            'categories' => $categoryRepository->all()]);
    }

    public function create(Request $request, ProductService $service)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $service->create(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('category_id')
        );

        $request->session()->flash('alert-success', 'Producto creado con exito');

        return back();
    }

    public function info($id, ProductRepository $productRepository)
    {
        $product = $productRepository->findOrfail($id);

        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
        ];
    }

    public function index(ProductRepository $productRepository)
    {
        return view('admin/products/index', [
            'products' => $productRepository->all()]);
    }

    public function delete($id, ProductService $service)
    {
        $service->delete($id);

        return back();
    }

    public function edit(CategoryRepository $categoryRepository,
                         ProductRepository $productRepository, string $id)
    {
        return view('admin/products/edit', [
            'categories' => $categoryRepository->all(),
            'products' => $productRepository->findOrfail($id)
        ]);
    }

    public function updateProduct(string $id, Request $request, ProductService $service)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $service->edit(
            $id,
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('category_id')
        );

        $request->session()->flash('alert-success', 'Producto editado');

        return redirect('admin/products/index');
    }


    public function autoComplete(Request $request)
    {
        $product = Product::select("name")
            ->where('name', 'like', "%{$request->terms}%")
            ->get();

        return response()->json($product);

    }

    public function findProduct(Request $request, ProductRepository $productRepository)
    {
        $find = $request->input('find');

        return view('admin/products/index', ['products' => $productRepository->where($find)]);

    }
}
