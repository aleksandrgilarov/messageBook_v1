<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name','email', 'link', 'text', 'ip', 'browser_info'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
