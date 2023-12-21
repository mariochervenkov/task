<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $rating
 * @property float $price
 * @property string $image_path
 */
class Product extends Model
{
    use HasFactory;

    public $appends = [
        'image_path'
    ];

    /**
     * @return string
     */
    public function getImagePathAttribute(): string
    {
        return asset('product.jpg');
    }
}
