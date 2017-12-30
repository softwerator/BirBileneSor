<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

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
