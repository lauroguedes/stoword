<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'native_language',
        'level',
        'qtd_sentences',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
