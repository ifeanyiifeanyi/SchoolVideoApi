<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    use HasFactory;
   
    public function user()
    {
        return $this->belongsTo(User::class, 'code', 'activation_code');
    }
}
