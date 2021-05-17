<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ClientFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function clientName($client_name)
    {
        return $this->where('client_name', $client_name);
    }

    public function clientId($id)
    {
        return $this->where('id', $id);
    }

    public function address1($address1)
    {
        return $this->where('address1', $address1);
    }

    public function address2($address2)
    {
        return $this->where('address2', $address2);
    }

    public function city($city)
    {
        return $this->where('city', $city);
    }

    public function state($state)
    {
        return $this->where('state', $state);
    }
    public function country($country)
    {
        return $this->where('country', $country);
    }

    public function zip($zip)
    {
        return $this->where('zip', $zip);
    }

    public function phoneNo1($phoneNo1)
    {
        return $this->where('phone_no1', $phoneNo1);
    }

    public function phoneNo2($phoneNo2)
    {
        return $this->where('phone_no2', $phoneNo2);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function email($email)
    {
        return $this->related('user', 'email', 'LIKE', '%'.$email.'%');
    }

    public function firstName($phoneNo2)
    {
        return $this->related('user', 'email', 'LIKE', '%'.$phoneNo2.'%');
    }

    public function lastName($phoneNo2)
    {
        return $this->related('user', 'email', 'LIKE', '%'.$phoneNo2.'%');
    }

    public function phone($phone)
    {
        return $this->related('user', 'email', 'LIKE', '%'.$phone.'%');
    }

    public function userStatus($status)
    {
        return $this->related('user', 'status', '=', $status);
    }

    public function userLastPasswordReset($userLastPasswordReset)
    {
        return $this->related('user', 'last_password_reset', '=', $userLastPasswordReset);
    }
}
