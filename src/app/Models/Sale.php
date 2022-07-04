<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'value',
        'commission'
    ];

    protected $hidden = ['seller_id', 'updated_at'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
