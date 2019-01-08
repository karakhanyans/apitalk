<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ModelsStore
 *
 * @property int $id
 * @property string $brand
 * @property string $number
 * @property string $name
 * @property string $type
 * @property string|null $street
 * @property string|null $city
 * @property string $state
 * @property string $country
 * @property string|null $postcode
 * @property string|null $phone_number
 * @property string $timezone
 * @property float|null $longitude
 * @property float|null $latitude
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereType($value)
 * @mixin \Eloquent
 */
class Store extends Model
{
    protected $table = "stores";
    protected $fillable = ['brand_id', 'number', 'name', 'type', 'street', 'city', 'state', 'country', 'postcode',
        'phone_number', 'timezone', 'longitude', 'latitude'];
    protected $appends = ['address'];
    protected $with = ['brand'];

    const TYPE_NOT_LICENSED = 0;
    const TYPE_LICENSED = 1;

    public function getAddressAttribute()
    {
        return $this->street . ',' . $this->city . ',' . $this->country;
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
