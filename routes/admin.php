<?php
declare(strict_types=1);

use App\Http\Actions\Admin;
use Illuminate\Support\Facades\Route;

Route::get('', Admin\IndexAction::class)
    ->name(Admin\IndexAction::ROUTE_NAME);

Route::get('delivery/map', Admin\ViewDeliveryMapAction::class)
    ->name(Admin\ViewDeliveryMapAction::ROUTE_NAME);

