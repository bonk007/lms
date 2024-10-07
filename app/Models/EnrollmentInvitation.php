<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnrollmentInvitation extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 0;
    public const STATUS_APPROVED = 1;
    public const STATUS_REJECTED = 2;
    public const MAIL_IN_QUEUE = 0;
    public const MAIL_SENT = 1;
    public const MAIL_FAILED = 2;

    /** @inheritdoc */
    protected $fillable = [
        'course_id',
        'user_id',
        'valid_through',
        'email',
        'token',
        'status',
        'mail_sending_status'
    ];

    /** @inheritdoc */
    protected $casts = [
        'valid_through',
    ];

    /** @inheritDoc */
    protected static function boot(): void
    {
        parent::boot();
        static::saving(static function (EnrollmentInvitation $invitation) {
            if (null !== $invitation->getAttribute('token')) {
                return $invitation;
            }
            return $invitation->setAttribute('token', encrypt(Str::uuid()))
                ->setAttribute('valid_through', $invitation->freshTimestamp()->addDays(3));
        });
    }

    /**
     * Get related course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get associated user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function valid(): bool
    {
        /** @var \Illuminate\Support\Carbon $validThrough */
        $validThrough = $this->getAttribute('valid_through');
        return $validThrough->gte($this->freshTimestamp());
    }

    public function approve(): self
    {
        DB::transaction(function () {

            $this->setAttribute('status', self::STATUS_APPROVED)->save();

            $user = $this->getAttribute('user_id');
            $course = $this->getAttribute('course_id');

            Enrollment::query()->create([
                'course_id' => $course,
                'user_id' => $user,
                'type' => Enrollment::TYPE_INVITATION,
                'status' => Enrollment::STATUS_APPROVED,
            ]);

        });

        return $this;
    }

    public function reject(): self
    {
        $this->setAttribute('status', self::STATUS_REJECTED)->save();
        return $this;
    }

    public static function flush(): void
    {
        DB::transaction(static function () {
            static::query()
                ->where('status', '!=',static::STATUS_APPROVED)
                ->whereDate('created_at', '<=', now()->subMonths(3)); // delete 3 mo rejected or pending invitation;
        });
    }
}
