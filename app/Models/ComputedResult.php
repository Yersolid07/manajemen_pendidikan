<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComputedResult extends Model
{
    protected $fillable = [
        'computation_type',
        'reference_id',
        'result_data',
        'computed_at',
        'is_stale',
    ];

    protected function casts(): array
    {
        return [
            'result_data' => 'array',
            'computed_at' => 'datetime',
            'is_stale' => 'boolean',
        ];
    }

    /**
     * Mark this result as stale (needs recomputation).
     */
    public function markStale(): void
    {
        $this->update(['is_stale' => true]);
    }

    /**
     * Scope to get fresh (non-stale) results.
     */
    public function scopeFresh($query)
    {
        return $query->where('is_stale', false);
    }
}
