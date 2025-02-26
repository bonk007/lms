<?php

namespace App\Http\Controllers;

use Illuminate\Database\Connection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GazerController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'url' => ['required', 'url'],
            'data' => ['required', 'array']
        ]);

        DB::transaction(static function (Connection $connection) use ($request) {
            $connection->table('gazer_records')
                ->insert([
                    'user_id' => $request->user()->id,
                    'url' => $request->url,
                    'data' => json_encode($request->data, JSON_THROW_ON_ERROR),
                ]);
        });

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
