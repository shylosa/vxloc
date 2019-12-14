<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Email
 *
 * @property int $id
 * @property string|null $email
 * @property int|null $contact_id
 * @property int $email_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Contact|null $contact
 * @method static Builder|Email newModelQuery()
 * @method static Builder|Email newQuery()
 * @method static Builder|Email query()
 * @method static Builder|Email whereContactId($value)
 * @method static Builder|Email whereCreatedAt($value)
 * @method static Builder|Email whereEmail($value)
 * @method static Builder|Email whereEmailStatus($value)
 * @method static Builder|Email whereId($value)
 * @method static Builder|Email whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Email extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
