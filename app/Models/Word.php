<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $users
 */
class Word extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'ipa',
        'translate',
        'meaning',
        'part_of_speech',
        'plural',
        'synonyms',
        'forms',
        'sentences',
    ];

    protected $casts = [
        'meaning' => 'array',
        'sentences' => 'array',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('favorite', 'created_at')
            ->withTimestamps();
    }
}
