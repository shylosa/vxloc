<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends AppModel
{
    protected $fillable = ['email'];

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
