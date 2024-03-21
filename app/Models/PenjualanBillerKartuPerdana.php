<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjualanBillerKartuPerdana extends Model
{
    use HasFactory;

    protected $table = 'penjualan_biller_kartu_perdana';

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
     * Get the supplier_pulsa that owns the DealerPulsa
     *
     * @return BelongsTo
     */
    public function kartu(): BelongsTo
    {
        return $this->belongsTo(Kartu::class, 'kartu_id', 'id');
    }
}
