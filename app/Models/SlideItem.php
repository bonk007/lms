<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlideItem extends Model
{
    protected $fillable = [
        'img',
        'caption'
    ];

    public function slide(): BelongsTo
    {
        return $this->belongsTo(Slide::class, 'slide_id');
    }
}
