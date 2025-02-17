<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'category_id',
        'price',
        'quantity',
        'minimum_quantity',
        'unit',
        'barcode',
        'attributes',
        'image_path',
    ];

    protected $casts = [
        'attributes' => 'array',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function isLowStock()
    {
        return $this->quantity <= $this->minimum_quantity;
    }

    public function updateStock($quantity, $type = 'in')
    {
        if ($type === 'in') {
            $this->quantity += $quantity;
        } else {
            $this->quantity -= $quantity;
        }
        $this->save();
    }
} 