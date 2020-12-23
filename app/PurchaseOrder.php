<?php

namespace App;

use Domain\Entities\User;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_order_products', 'purchase_order_id', 'product_id');
    }

    /**
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->finalPrice;
    }

    /**
     * @param float $finalPrice
     */
    public function setFinalPrice(float $finalPrice): void
    {
        $this->finalPrice = $finalPrice;
    }

    /**
     * @return string|null
     */
    public function getObservation(): ?string
    {
        return $this->observation;
    }

    /**
     * @param string|null $observation
     */
    public function setObservation(?string $observation): void
    {
        $this->observation = $observation;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class,'delivery_id');
    }
}
