<?php
namespace App\Components\Currencies;

use SSD\Currency\Currencies\BaseCurrency;

class RUB extends BaseCurrency
{
    /**
     * @var string
     */
    protected $prefix = 'руб';

    /**
     * @var string
     */
    protected $postfix = 'RUB';
}