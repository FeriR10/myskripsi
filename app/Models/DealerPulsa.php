<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealerPulsa extends Model
{
    use HasFactory;

    protected $table = 'dealer_pulsa';

    /**
     * Get the dealer that owns the DealerPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    
    /**
     * Get the dealer that owns the DealerPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class, 'dealer_id', 'id');
    }

    /**
     * Get the supplier_pulsa that owns the DealerPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier_pulsa(): BelongsTo
    {
        return $this->belongsTo(SupplierPulsa::class, 'supplier_pulsa_id', 'id');
    }

    /**
     * Get the supplier_pulsa that owns the DealerPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kartu(): BelongsTo
    {
        return $this->belongsTo(Kartu::class, 'kartu_id', 'id');
    }
}
