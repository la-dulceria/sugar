<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function new()
    {
        return view('admin.categories.new');
    }

    public function create(Request $request, CategoryService $service)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $service->create(
            $request->input('name')
        );

        $request->session()->flash('alert-success', 'Categoria creada con exito');

        return view('admin.categories.new');

    }

    public function index(CategoryRepository $repository)
    {
        return view('admin.categories.index', ['category' => $repository->all()]);
    }

    public function confirm($id, CategoryRepository $repository, CategoryService $service)
    {
        return view('admin.categories.confirm', ['category' => $repository->findOrfail($id)]);
    }

    public function delete(Request $request, $id, CategoryService $service, CategoryRepository $repository)
    {
        $service->delete($id);

        $request->session()->flash('alert-success', 'Categoria Eliminada con exito');

        return view('admin.categories.index', ['category' => $repository->all()]);
    }

    public function edit($id, CategoryRepository $repository)
    {
        return view('admin.categories.edit', ['category' => $repository->findOrfail($id)]);
    }

    public function update(string $id, Request $request, CategoryService $service, CategoryRepository $repository)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $service->edit(
            $id,
            $request->input('name')
        );

        $request->session()->flash('alert-success', 'Categoria editada');

        return view('admin.categories.index', ['category' => $repository->all()]);
    }

}
