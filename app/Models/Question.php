<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description_id', 'answer_id',
    ];

    public function description()
    {
        return $this->belongsTo(Answer::class,'description_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class,'answer_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Question::class, 'question_tag', 'tag_id');
    }

}
