<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends AppModel
{

    protected $fillable = ['phone'];

    /**
     * User-phones Database Dependencies
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }
}
