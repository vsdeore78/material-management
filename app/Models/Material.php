<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'opening_balance',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(MaterialTransaction::class);
    }

    /**
     * Calculate current balance from opening balance
     * and all inward/outward transactions.
     */
    public function getCurrentBalanceAttribute()
    {
        return $this->opening_balance
            + $this->transactions()->sum('quantity');
    }
}