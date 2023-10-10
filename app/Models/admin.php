<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;

    protected $fillable =['email','fname','lname','type_id','verification_code'];

    public $incrementing = false;

    protected $primarykey = 'email';
}
