<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $guarded = [];
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
}
