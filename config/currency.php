<?php

return [
    "key" => "currency",
    "default" => "rub",
    "currencies" => [
        "rub" => \App\Components\Currencies\RUB::class,
        "usd" => \SSD\Currency\Currencies\USD::class,
        "eur" => \SSD\Currency\Currencies\EUR::class
    ]
];