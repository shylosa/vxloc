<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    public const IS_VISIBLE = 1;
    public const IS_HIDE = 0;

    protected $fillable = ['phone'];

    /**
     * User-phones Database Dependencies
     *
     * @return BelongsTo
     */
    public function phones(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }
}
