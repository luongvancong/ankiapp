<?php

namespace App\Hocs\Subscribers;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model {

    public function getEmail()
    {
        return $this->email;
    }
}