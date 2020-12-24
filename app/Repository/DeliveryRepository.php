<?php


namespace App\Repository;


use App\Delivery;

class DeliveryRepository
{
    public function save(Delivery $delivery)
    {
        $delivery->save();
    }

    public function all()
    {
        return Delivery::all();
    }

    public function findOrfail($id)
    {
        return Delivery::findOrfail($id);
    }

    public function delete(Delivery $delivery)
    {
        $delivery->delete();
    }

}
