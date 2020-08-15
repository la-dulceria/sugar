<?php
declare(strict_types=1);

namespace Domain\Entities;

use Domain\Enums\Currencies;
use Domain\Interfaces\PayableInterface;
use Money\Currency;
use Money\Money;

class Product implements PayableInterface
{
    private string $amount;

    public function getPrice(): Money
    {
        return new Money($this->amount, new Currency(Currencies::DEFAULT));
    }
}
