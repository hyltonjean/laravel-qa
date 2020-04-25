<?php

namespace App;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'slug', 'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = $val;
        $this->attributes['slug'] = Str::slug($val);
    }
}
