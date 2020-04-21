<?php

namespace App\Hocs\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'cit_id';
    public $timestamps    = false;

    protected $guarded = array('cit_id');

    public function getId()
    {
        return $this->cit_id;
    }

    public function getName()
    {
        return $this->cit_name;
    }
}
