<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','email','msg'];

    public $incrementing = false;

    protected $primarykey = 'id';
}
