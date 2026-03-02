<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'price', 'sale_price', 
        'stock', 'description', 'image', 'is_active', 'is_delete'
    ];

    // Tạo mối quan hệ: Một sản phẩm thuộc về một Danh mục
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
