<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'key',
        'value',
        'type'
    ];

    protected $appends = [
        'value_full',
    ];

    public function getValueFullAttribute()
    {
        if (strlen($this->value) > 0) {
            return env('OSS_URL').'/'.$this->value;
        }
        return asset('assets/cms/images/no-img.png');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('Y-m-d H:i:s');
    }

}
