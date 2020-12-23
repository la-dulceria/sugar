<?php

namespace App\Http\Controllers;

use App\Repository\DeliveryRepository;
use App\Repository\ProductRepository;
use App\Service\PurchaseOrderService;
use Illuminate\Http\Request;

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
        $service->create(
            $request->input('product_id'),
            $request->input('direction'),
            $request->input('finalPrice'),
            $request->input('observation'),
            $request->input('user'),
            $request->input('delivery_id')
        );
    }
}
