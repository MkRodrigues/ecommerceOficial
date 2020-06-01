<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'image', 'description', 'price', 'discount', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagID)
    {
        return in_array($tagID, $this->tags->pluck('id')->toArray());
    }

    public function discountPrice()
    {
        return $this->formatMoney($this->price * (1 - $this->discount / 100));
    }

    public function price()
    {
        return $this->formatMoney($this->price);
    }

    public function formatMoney($value)
    {
        return 'R$ ' . number_format($value, 2);
    }
}
