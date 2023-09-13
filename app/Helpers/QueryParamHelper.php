<?php

namespace App\Helpers;

use Illuminate\Http\Request;

final class QueryParamHelper
{
    public static function perPage(Request $request): string|array|null
    {
        if ($request->query('per_page') > 100) {
            return 100;
        }

        if ($request->query('per_page') < 10) {
            return 10;
        }

        return $request->query('per_page', 10);
    }

    public static function page(Request $request): string|array|null
    {
        return $request->query('page', 1);
    }

    public static function orderBy(Request $request): string|array|null
    {
        return $request->query('order_by', 'id');
    }

    public static function order(Request $request): string|array|null
    {
        return $request->query('order', 'asc');
    }
}
