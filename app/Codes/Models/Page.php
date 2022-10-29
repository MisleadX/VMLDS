<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'key',
        'value',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('Y-m-d H:i:s');
    }

}
