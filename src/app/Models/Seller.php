<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'commission'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
