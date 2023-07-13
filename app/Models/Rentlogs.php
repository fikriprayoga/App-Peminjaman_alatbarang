<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rentlogs extends Model
{
    use HasFactory;

    protected $table ='rent_logs';

    protected $fillable = [
        'alatbarang_id', 'user_id', 'tanggal_peminjaman', 'tanggal_pengembalian'
    ];

    /**
     * Get the alatbarang that owns the Rentlogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alatbarang(): BelongsTo
    {
        return $this->belongsTo(Alatbarangs::class, 'alatbarang_id', 'id');
    }

    /**
     * Get the user that owns the Rentlogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
