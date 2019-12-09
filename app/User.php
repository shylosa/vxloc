<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * User-contact Database Dependencies
     *
     * @return hasOne
     */
    public function contact(): hasOne
    {
        return $this->hasOne(Contact::class);
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
        //'name'
        $this->fill($fields);
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


}
