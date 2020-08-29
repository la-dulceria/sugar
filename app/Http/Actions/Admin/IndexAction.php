<?php
declare(strict_types=1);

namespace App\Http\Actions\Admin;

class IndexAction
{
    public const ROUTE_NAME = 'Admin.index';

    public function __invoke()
    {
        return view('admin.index');
    }
}
