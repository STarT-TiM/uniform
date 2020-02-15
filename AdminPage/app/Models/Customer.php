<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
//    protected $guarded = [];
    protected $fillable = ['username', 'password', 'fullname', 'shortname' , 'email' , 'phone', 'address', 'age', 'gender' , 'is_verity' ,'is_test'];

}

