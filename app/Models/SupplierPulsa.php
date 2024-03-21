<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierPulsa extends Model
{
    use HasFactory;

    protected $table = 'supplier_pulsa';

    /**
     * Get the supplier that owns the SupplierPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    
    /**
     * Get the supplier that owns the SupplierPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kartu(): BelongsTo
    {
        return $this->belongsTo(Kartu::class, 'kartu_id', 'id');
    }
    
}
