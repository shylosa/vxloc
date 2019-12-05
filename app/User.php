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
    public function category(): BelongsTo
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
     * User-phones Database Dependencies
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
}
