<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends AppModel
{

    protected $fillable = ['contact_id', 'phone', 'phone_status'];

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
