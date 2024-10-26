<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'address',
        'price',
        'currency',
    ];

    protected $appends = [
        'address',
    ];

    //
    public function getAddressAttribute()
    {
        return is_string($this->attributes['address']) ? @json_decode($this->attributes['address'], true) : null;
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = json_encode($value);
    }
}
