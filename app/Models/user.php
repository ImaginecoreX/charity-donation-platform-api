<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'fname', 'lname', 'mobile', 'password', 'status_id', 'gender_id'];
    public $incrementing = false;
    protected $primaryKey = 'email';
}
