<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Contact
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $address
 * @property string|null $zipcode
 * @property int $country_id
 * @property int $contact_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Country $country
 * @property-read Collection|Email[] $emails
 * @property-read int|null $emails_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Phone[] $phones
 * @property-read int|null $phones_count
 * @property-read User $user
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereAddress($value)
 * @method static Builder|Contact whereContactStatus($value)
 * @method static Builder|Contact whereCountryId($value)
 * @method static Builder|Contact whereCreatedAt($value)
 * @method static Builder|Contact whereFirstname($value)
 * @method static Builder|Contact whereId($value)
 * @method static Builder|Contact whereLastname($value)
 * @method static Builder|Contact whereUpdatedAt($value)
 * @method static Builder|Contact whereUserId($value)
 * @method static Builder|Contact whereZipcode($value)
 * @mixin Eloquent
 */
class Contact extends AppModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address',
        'zipcode',
        'country_id',
        'contact_status'
    ];

    /**
     * Contact-user Database Dependencies
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * Contact-country Database Dependencies
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Contact-phones Database Dependencies
     *
     * @return hasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * Contact-emails Database Dependencies
     *
     * @return hasMany
     */
    public function emails(): hasMany
    {
        return $this->hasMany(Email::class);
    }

    /**
     * Add contact
     *
     * @param $fields
     */
    public function addContact($fields): void
    {
        $contact = new static();
        $contact->fill($fields);
        $contact->save();

    }

    /**
     * Edit existing contact
     *
     * @param $fields
     */
    public function editContact($fields): void
    {
        $this->fill($fields);
        $this->save();
    }

    /**
     * Set country for current contact
     *
     * @param $id
     */
    public function setCountry($id): void
    {
        if($id === null) {return;}
        $this->country_id = $id;
        $this->save();
    }

    /**
     * Set phones for current contact
     *
     * @param array $phones
     * @param array $states
     * @param int $id
     */
    public function setPhones(array $phones, array $states, int $id): void
    {
        if($phones === null || $states === null) { return; }
        foreach ($phones as $key => $phone) {
            if ($phone) {
                Phone::updateOrCreate(
                    ['id' => $key],
                    ['phone' => $phone, 'phone_status' => $states[$key], 'contact_id' => $id]);
            }

        }
    }

    /**
     * Set emails for current contact
     *
     * @param array $emails
     * @param array $states
     * @param int $id
     */
    public function setEmails(array $emails, array $states, int $id): void
    {
        if($emails === null || $states === null) { return; }
        foreach ($emails as $key => $email) {
            if ($email) {
                Email::updateOrCreate(
                    ['id' => $key],
                    ['email' => $email, 'email_status' => $states[$key], 'contact_id' => $id]);
            }
        }

    }

    /**
     * Get name for country
     *
     * @return string
     */
    public function getCountryName()
    {
        return ($this->country !== null)
            ?   $this->country->country_name
            :   'Нет страны';
    }

    /**
     * Get phone numbers
     *
     * @return string
     */
    public function getPhones()
    {
        return (!$this->phones->isEmpty())
            ?   implode(', ', $this->phones->pluck('phone')->all())
            : 'Нет номеров';
    }

    /**
     * Get emails
     *
     * @return string
     */
    public function getEmails()
    {
        return (!$this->emails->isEmpty())
            ?   implode(', ', $this->emails->pluck('email')->all())
            : 'Нет адресов';
    }

    /**
     * Add new field in database
     *
     * @param $class
     * @return mixed
     */
    public function addField($class)
    {
        $field = $class::create(['contact_id' => $this->id]);
        $field->save();

        return $field;
    }
}
