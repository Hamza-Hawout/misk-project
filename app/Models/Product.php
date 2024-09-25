<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'price',
        'seller_id',
        'image',
    ];
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


}
