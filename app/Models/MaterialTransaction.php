<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialTransaction extends Model
{
    protected $fillable = [
        'material_id',
        'transaction_date',
        'quantity',
    ];

    /**
     * A transaction belongs to a material.
     * Include soft-deleted materials so historical transactions
     * can still display their material information.
     */
    public function material()
    {
        return $this->belongsTo(Material::class)->withTrashed();
    }
}