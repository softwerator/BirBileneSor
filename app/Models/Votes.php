<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'vote'
    ];

}
