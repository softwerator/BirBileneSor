<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question_Tag extends Model
{
    protected $table = 'question_tag';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag'
    ];

    protected $dates = null;

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tag', 'question_id');
    }

}
