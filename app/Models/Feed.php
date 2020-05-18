<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //
    protected $fillable = [
        'url',
        'name'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
