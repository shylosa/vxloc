<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends AppModel
{
    protected $fillable = ['email'];

    /**
     * User-emails Database Dependencies
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
