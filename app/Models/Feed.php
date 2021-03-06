<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //
    protected $fillable = [
        'name',
        'url',
        'description'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
