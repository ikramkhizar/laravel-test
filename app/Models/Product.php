<?php

namespace App\Models;

use App\Models\ProductStock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}
