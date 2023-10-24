<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;

    protected $fillable =['id','admin_email','title','description','time','location_link','district_id','status_id','event_statuses_id'];

    public $incrementing = false;

    protected $primarykey = 'id';
}
