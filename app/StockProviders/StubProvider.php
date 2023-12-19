<?php

namespace App\StockProviders;

use App\Interfaces\StockProviderInterface;

/**
 * Класс-заглушка
 *
 * Всегда возвращает статичный контент
 */
class StubProvider implements StockProviderInterface
{
    public function getData(): string
    {
        return file_get_contents(__DIR__ . '/Stub/stub.json');
    }
}
