<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function resolvePerPage(Request $request): int
    {
        $default = (int) config('pagination.default', 15);
        $max     = (int) config('pagination.max', 100);
        $param   = config('pagination.param', 'per_page');

        $value = (int) $request->query($param, $default);

        return max(1, min($value, $max));
    }
}
