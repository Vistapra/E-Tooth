<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChMessage extends Model
{
    use UUID;

    protected $fillable = ['from_id', 'to_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}