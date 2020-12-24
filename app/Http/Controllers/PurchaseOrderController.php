<?php

namespace App\Http\Controllers;

use App\Repository\DeliveryRepository;
use App\Repository\ProductRepository;
use App\Repository\PurchaseOrderRepository;
use App\Service\PurchaseOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function new(ProductRepository $productRepository,
                        DeliveryRepository $deliveryRepository)
    {
        return view('admin/purchaseOrder/new',[
            'products'=> $productRepository->all(),
            'deliveries' => $deliveryRepository->all()
        ]);
    }

    public function create(Request $request, PurchaseOrderService $service)
    {
        $user = Auth::user();

        $service->create(
            $request->input('direction'),
            $request->input('total'),
            $request->input('observation'),
            $user,
            $request->input('delivery_id'),
            $request->input('products'),
            $request->input('quantities'),
            $request->input('prices')
        );

        $request->session()->flash('alert-success', 'Orden creada con exito');

        return back();
    }

    public function index(PurchaseOrderRepository $purchaseOrderRepository)
    {
        return view('admin/purchaseOrder/index',
            ['orders' => $purchaseOrderRepository->all()]);
    }

    public function delete($id, Request $request, PurchaseOrderService $service)
    {
        $service->delete($id);

        $request->session()->flash('alert-success', 'Orden eliminada con exito');

        return redirect('admin/purchaseOrder/index');
    }
}
