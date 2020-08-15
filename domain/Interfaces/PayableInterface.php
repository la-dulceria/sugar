<?php
declare(strict_types=1);

namespace Domain\Interfaces;

use Money\Money;

interface PayableInterface
{
    public function getPrice(): Money;
}
