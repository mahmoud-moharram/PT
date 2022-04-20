<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nmap extends Model
{
    use HasFactory;

    protected $fillable = ['pt_settings_id','status','type','result','user_id'];

    public function settings(){
        return $this->belongsTo(PtSetting::class,'pt_settings_id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
