<?php

namespace App;

use Domain\Entities\User;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
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
        return $this->hasOne(User::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function details()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_order_id');
    }
}
