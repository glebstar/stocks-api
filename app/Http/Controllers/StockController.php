<?php

namespace App\Http\Controllers;

use App\Interfaces\StockProviderInterface;
use Illuminate\Http\JsonResponse;
use App\Models\Stock;
use JsonMachine\Items;

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
            // получает данные из json частями
            $data = Items::fromString($this->provider->getData());
            foreach ($data as $d) {
                foreach ($d->stocks as $s) {
                    /**
                     * @var $stock Stock
                     */
                    $stock = Stock::where('id', '<>', 1)
                        ->where('id', $s->uuid)
                        ->first();
                    if (!$stock) {
                        // Общий склад
                        $stock = Stock::find(1);
                    }
                    $stock->remaining()->create([
                        'quantity' => $s->quantity,
                    ]);
                }
            }

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
