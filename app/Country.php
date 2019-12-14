<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Country
 *
 * @property int $id
 * @property string $country_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Contact[] $contacts
 * @property-read int|null $contacts_count
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country whereCountryName($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_name'];

    /**
     * Contacts-country Database Dependencies
     *
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
