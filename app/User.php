<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'address',
        'zipcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public function phones(): hasMany
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add user
     *
     * @param $fields
     * @return static
     */
    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    /**
     * Edit existing user
     *
     * @param $fields
     */
    public function edit($fields): void
    {
        $this->fill($fields); //'name', 'lastname', 'address', 'zipcode', 'email'
        $this->save();
    }

    /**
     * Remove existing user
     */
    public function remove(): void
    {
        try {
            $this->delete();
        } catch (\Exception $e) {
        }
    }

    /**
     * Generate (encryption) user password
     *
     * @param string $password
     */
    public function generatePassword($password): void
    {
        if($password !== null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    /**
     * Set country for current user
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
     * Set phones for current user
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
            ?   $this->country->name
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
        return (!$this->phones->isEmpty())
            ?   implode(', ', $this->emails->pluck('email')->all())
            : 'Нет адресов';
    }
}
