<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFreeOrder extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
