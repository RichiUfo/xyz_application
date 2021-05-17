<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use EloquentFilter\Filterable;

class Client extends Model
{
    use HasFactory, Sortable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
        'status'
    ];

    public $sortable = [
        'id',
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
        'status',
        'start_validity',
        'end_validity'
    ];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setStartValidityAttribute($value)
    {
        $this->attributes['start_validity'] = date("Y-m-d H:i:s");
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setEndValidityAttribute($value)
    {
        $this->attributes['end_validity'] = date('Y-m-d H:i:s',strtotime('+15 days',date("Y-m-d H:i:s")));
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'name' => $this->client_name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zipcode' => $this->zip,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phoneNo1' => $this->phone_no1,
            'phoneNo2' => !empty($this->phone_no2) ? $this->phone_no2 : "",
            'totalUser' => [
                'all' => $this->user()->count(),
                'active' => $this->user()->where('status', User::STATUS['active'])->count(),
                'inactive' => $this->user()->where('status', User::STATUS['inactive'])->count(),
            ],
            'startValidity' => $this->start_validity,
            'endValidity' => $this->end_validity,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }

    public function registerFormat()
    {
        return [
            'name' => $this->client_name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zipcode' => $this->zip,
            'latitude' => $this->latitude,
            'user' => [
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'email' => $this->user->email,
                'password' => $this->user->password,
                'passwordConfirmation' => $this->user->password,
                'phone' => $this->user->phone,
            ],
        ];
    }
}
