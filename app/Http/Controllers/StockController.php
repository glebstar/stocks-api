<?php

namespace App\Http\Controllers;

use App\Interfaces\StockProviderInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockProviderInterface $provider;

    public function __construct(StockProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Получает данные от провайдера, заносит данные в базу данных и возвращает результат работы
     *
     * @return JsonResponse
     */
    public function getForData(): JsonResponse
    {
        try {
            $data = $this->provider->getData();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => [
                    $e->getMessage(),
                ]
            ]);
        }

        return response()->json(['success' => true]);
    }
}
