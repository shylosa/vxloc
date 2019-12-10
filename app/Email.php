<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends AppModel
{
    protected $fillable = ['contact_id', 'email', 'email_status'];

    /**
     * Contact-emails Database Dependencies
     *
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
