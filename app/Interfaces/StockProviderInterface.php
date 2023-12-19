<?php

namespace App\Interfaces;

use Exception;

interface StockProviderInterface
{
    /**
     * @return string
     * @throws Exception
     */
    public function getData(): string;
}
