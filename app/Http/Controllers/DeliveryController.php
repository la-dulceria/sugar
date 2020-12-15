<?php

namespace App\Http\Controllers;

use App\Repository\DeliveryRepository;
use App\Service\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function new()
    {
        return view('admin/deliveries/new');
    }

    public function create(Request $request, DeliveryService $service)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $service->create(
            $request->input('name'),
            $request->input('date')
        );
        $request->session()->flash('alert-success', 'Envio creado con exito');

        return view('admin/deliveries/new');
    }

    public function index(DeliveryRepository $deliveryRepository)
    {
        return view('admin/deliveries/index', [
            'deliveries' => $deliveryRepository->all()]);
    }

    public function delete($id, DeliveryRepository $deliveryRepository,
                           DeliveryService $service)
    {
        $service->delete($id);
        return view('admin/deliveries/index', [
            'deliveries' => $deliveryRepository->all()]);
    }

    public function edit($id, DeliveryRepository $deliveryRepository)
    {
        return view('admin/deliveries/edit', [
            'delivery' => $deliveryRepository->findOrfail($id)]);
    }

    public function update(Request $request, $id,
                           DeliveryService $service,
                            DeliveryRepository $deliveryRepository)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $service->edit(
            $id,
            $request->input('name'),
            $request->input('date')
        );

        return view('admin/deliveries/index', [
            'deliveries' => $deliveryRepository->all()]);

    }
}
