<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjualanBillerPulsa extends Model
{
    use HasFactory;

    protected $table = 'penjualan_biller_pulsa';

    /**
     * Get the dealer that owns the DealerPulsa
     *
     * @return BelongsTo
     */
    public function biller(): BelongsTo
    {
        return $this->belongsTo(Biller::class, 'biller_id', 'id');
    }
    
    /**
     * Get the dealer that owns the DealerPulsa
     *
     * @return BelongsTo
     */
    public function biller_pulsa(): BelongsTo
    {
        return $this->belongsTo(BillerPulsa::class, 'biller_pulsa_id', 'id');
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
