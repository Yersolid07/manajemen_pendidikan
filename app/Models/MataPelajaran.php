<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'code',
        'name',
        'group_name',
        'education_level',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope to filter by education level.
     */
    public function scopeForLevel($query, string $level)
    {
        return $query->where(function ($q) use ($level) {
            $q->where('education_level', $level)
              ->orWhere('education_level', 'BOTH');
        });
    }

    /**
     * Scope to filter active subjects.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
