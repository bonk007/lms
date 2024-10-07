<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instance extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritDoc */
    protected $fillable = [
        'initiated_by',
        'name',
        'description',
        'logo',
        'banner'
    ];

    /**
     * Get related user as instance's initiator
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contributors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'instance_contributors', 'instance_id', 'user_id')
            ->withPivotValue('status');
    }
}
