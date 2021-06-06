<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable=['employee_id','status','branch_id','image','created_at','updated_at'];
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
