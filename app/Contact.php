<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

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
     * User-country Database Dependencies
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * User-country Database Dependencies
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * User-phones Database Dependencies
     *
     * @return hasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * User-emails Database Dependencies
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
     * @param int $contactId
     */
    public function setPhones(array $phones, array $states, int $contactId): void
    {
        if($phones === null || $states === null) { return; }
        foreach ($phones as $key => $phone) {
            if ($phone) {
                Phone::updateOrCreate(
                    ['id' => $key],
                    ['phone' => $phone, 'phone_status' => $states[$key], 'contact_id' => $contactId]);
            }

        }
    }

    /**
     * Set emails for current contact
     *
     * @param array $emails
     * @param array $states
     * @param int $contactId
     */
    public function setEmails(array $emails, array $states, int $contactId): void
    {
        if($emails === null || $states === null) { return; }
        foreach ($emails as $key => $email) {
            if ($email) {
                Email::updateOrCreate(
                    ['id' => $key],
                    ['email' => $email, 'email_status' => $states[$key], 'contact_id' => $contactId]);
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
}
