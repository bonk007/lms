<?php

namespace App\Models;

use App\Models\Sessions\CourseSession;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Settings\Contracts\Configurable;

class Course extends Model implements Configurable
{
    use HasFactory, SoftDeletes;

    /** @inheritDoc */
    protected $fillable = [
        'instance_id',
        'created_by',
        'name',
        'description',
        'banner'
    ];

    /** @inheritDoc */
    protected $appends = [
        'public_enrollment'
    ];

    /**
     * Get related user as course creator
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get related instance who belongs the course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instance(): BelongsTo
    {
        return $this->belongsTo(Instance::class, 'instance_id');
    }

    /**
     * Get related topics
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'course_id')
            ->orderBy('sort_index');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    /**
     * Defines mutator of `public_enrollment` attribute
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function publicEnrollment(): Attribute
    {
        return new Attribute(get: function (): bool {
            $value = settings()->for($this)
                ->get('courses.public_enrollment', false);

            if (null === $value) {
                settings()->for($this)
                    ->set('courses.public_enrollment', false);
            }

            return $value;
        }, set: function (bool $value) {
            settings()->for($this)
                ->set('courses.public_enrollment', $value);
        });
    }

    public function startSession(User $user): ?CourseSession
    {
        if (!$this->exists()) {
            return null;
        }

        $session = new CourseSession([
            'last_activity_at' => $this->freshTimestamp()
        ]);

        $session->user()->associate($user);
        $session->course()->associate($this);

        $session->save();

        return $session;
    }
}
