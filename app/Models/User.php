<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\Activity;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'is_online'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function initiatedInstances(): HasMany
    {
        return $this->hasMany(Instance::class, 'initiated_by');
    }

    public function contributors(): BelongsToMany
    {
        return $this->belongsToMany(Instance::class, 'instance_contributors', 'user_id', 'instance_id')
            ->withPivot(['status']);
//            ->withPivotValue('status');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

    public function createdCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function latestActivity(): Attribute
    {
        return new Attribute(get: fn() => $this->activity()->latest());
    }

    public function isOnline(): Attribute
    {
        return (new Attribute(get: function () {
            $latestActivity = $this->activity()->latest();

            if (null === $latestActivity) {
                return false;
            }

            $activityTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $latestActivity['created_at']);
            return $activityTimestamp?->gt(now()->subMinutes(15));

        }))->shouldCache();
    }

    public function activity(): Activity
    {
        return new Activity($this);
    }
}
