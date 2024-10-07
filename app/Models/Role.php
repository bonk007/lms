<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /** @inheritdoc */
    public $incrementing = false;

    /** @inheritdoc */
    protected $keyType = 'string';

    /** @inheritdoc */
    protected $fillable = [
        'id',
        'name',
        'description',
        'permission_id'
    ];

    /**
     * Get attached permission
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    /**
     * Get assigned users
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
