<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    private CategoryService $service;
    private CategoryRepository $repository;

    public function __construct(
        CategoryService $service,
        CategoryRepository $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function new()
    {
        return view('admin.categories.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $this->service->create(
            $request->input('name')
        );

        $request->session()->flash('alert-success', 'Categoria creada con exito');

        return back();
    }

    public function index()
    {
        return view('admin.categories.index', ['category' => $this->repository->all()]);
    }

    public function confirm($id)
    {
        return view('admin.categories.confirm',
            ['category' => $this->repository->findOrfail($id)]);
    }

    public function delete($id, Request $request)
    {
        try {
            $this->service->delete($id);
        } catch (ValidationException $exception) {
            $request->session()->flash('alert-danger', 'No se ha podido eliminar la categoría, verifique que no exista productos cargados con la misma.');
            return back();
        }

        $request->session()->flash('alert-success', 'Categoria eliminada con exito');

        return back();
    }

    public function edit($id)
    {
        return view('admin.categories.edit',
            ['category' => $this->repository->findOrfail($id)]);
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $this->service->edit(
            $id,
            $request->input('name')
        );

        $request->session()->flash('alert-success', 'Categoria editada');

        return redirect('admin');
    }
}
