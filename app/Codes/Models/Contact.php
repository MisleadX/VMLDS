<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'status'
    ];

    protected $dates = [
        'created_at',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('Y-m-d H:i:s');
    }


}
