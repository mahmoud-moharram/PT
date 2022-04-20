<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtSetting extends Model
{
    use HasFactory;
    protected $fillable = ['domain'];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
