<?php
declare(strict_types=1);

namespace App\Http\Actions\Admin;

class ViewDeliveryMapAction
{
    public const ROUTE_NAME = 'Admin.Deliveries.map';

    public function __invoke()
    {
        return view('admin.deliveries.map');
    }
}
