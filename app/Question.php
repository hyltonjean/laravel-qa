<?php

namespace App;

use App\User;
use App\Answer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

class Question extends Model
{
    protected $fillable = [
        'title', 'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); // 'question_id', 'user_id');
    }

    public function votes()
    {
        return $this->morphedByMany(User::class, 'votable');
    }

    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = $val;
        $this->attributes['slug'] = Str::slug($val);
    }

    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return 'answered-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }

    public function getBodyHtmlAttribute()
    {
        return (new CommonMarkConverter())->convertToHtml($this->body);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
