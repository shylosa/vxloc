<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends AppModel
{

    protected $fillable = ['phone', 'phone_status', 'user_id'];

    /**
     * Contact-phones Database Dependencies
     *
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);

    }
}
