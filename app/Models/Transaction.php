<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'type', 'reference_no', 'transaction_date', 'note'
    ];
    protected function casts(): array
    {
        return [
            'transaction_date' => 'date'
        ];
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

 public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
public function typeLabel(): string
{
    return $this->type === 'in' ? 'Barang masuk' : 'Barang keluar';
}
}
