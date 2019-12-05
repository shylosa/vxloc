<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
    public const IS_VISIBLE = 1;
    public const IS_HIDE = 0;

    protected $fillable = ['email'];

    /**
     * User-emails Database Dependencies
     *
     * @return BelongsTo
     */
    public function emails(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
