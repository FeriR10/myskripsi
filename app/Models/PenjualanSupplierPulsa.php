<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjualanSupplierPulsa extends Model
{
    use HasFactory;

    protected $table = 'penjualan_supplier_pulsa';

    /**
     * Get the supplier that owns the PenjualanSupplierPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    
    /**
     * Get the supplier that owns the PenjualanSupplierPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class, 'dealer_id', 'id');
    }

    /**
     * Get the dealer that owns the DealerPulsa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier_pulsa(): BelongsTo
    {
        return $this->belongsTo(SupplierPulsa::class, 'dealer_pulsa_id', 'id');
    }

    /**
     * Get the supplier_pulsa that owns the DealerPulsa
     *
     * @return BelongsTo
     */
    public function pulsa(): BelongsTo
    {
        return $this->belongsTo(Pulsa::class, 'pulsa_id', 'id');
    }
    
    /**
     * Get the supplier_pulsa that owns the DealerPulsa
     *
     * @return BelongsTo
     */
    public function kartu(): BelongsTo
    {
        return $this->belongsTo(Kartu::class, 'kartu_id', 'id');
    }
}
