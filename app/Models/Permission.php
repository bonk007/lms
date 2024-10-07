<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    /** @inheritdoc */
    public $incrementing = false;

    /** @inheritdoc */
    protected $keyType = 'string';

    /** @inheritDoc */
    protected $fillable = [
        'id',
        'name',
        'description',
        'privileges'
    ];

    /** @inheritdoc */
    protected $casts = [
        'privileges' => 'array'
    ];

    /**
     * Get associated roles
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'permission_id');
    }
}
