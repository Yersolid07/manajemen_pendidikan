<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'organization_id';

    /**
     * The "type" of the primary key ID.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    protected $fillable = [
        'organization_id',
        'name',
        'npsn',
        'education_type',
        'status_school',
        'latitude',
        'longitude',
        'province_code',
        'province_name',
        'regency_code',
        'regency_name',
        'district_code',
        'district_name',
        'village_code',
        'village_name',
        'street_name',
        'administrative_area',
        'is_school',
        'is_active',
        'is_lock',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'double',
            'longitude' => 'double',
            'is_school' => 'boolean',
            'is_active' => 'boolean',
            'is_lock' => 'boolean',
        ];
    }

    /**
     * Get all users belonging to this organization.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'organization_id', 'organization_id');
    }

    /**
     * Scope to filter only SMA schools.
     */
    public function scopeSma($query)
    {
        return $query->where('education_type', 'SMA');
    }

    /**
     * Scope to filter only SMK schools.
     */
    public function scopeSmk($query)
    {
        return $query->where('education_type', 'SMK');
    }

    /**
     * Scope to filter SMA & SMK.
     */
    public function scopeSmaSmk($query)
    {
        return $query->whereIn('education_type', ['SMA', 'SMK']);
    }

    /**
     * Scope to filter only active organizations.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
