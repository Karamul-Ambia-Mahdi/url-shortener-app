<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'original_url',
        'shortened_url',
        'visits',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
