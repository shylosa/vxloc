<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Phone
 *
 * @property int $id
 * @property string|null $phone
 * @property int|null $contact_id
 * @property int $phone_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Contact|null $contact
 * @method static Builder|Phone newModelQuery()
 * @method static Builder|Phone newQuery()
 * @method static Builder|Phone query()
 * @method static Builder|Phone whereContactId($value)
 * @method static Builder|Phone whereCreatedAt($value)
 * @method static Builder|Phone whereId($value)
 * @method static Builder|Phone wherePhone($value)
 * @method static Builder|Phone wherePhoneStatus($value)
 * @method static Builder|Phone whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Phone extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
