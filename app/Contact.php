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
        'firstname',
        'lastname',
        'address',
        'zipcode',
        'country_id',
        'status'
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
     * @param $ids
     */
    public function setPhones($ids): void
    {
        if($ids === null){return;}

        $this->phones()->sync($ids);
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
