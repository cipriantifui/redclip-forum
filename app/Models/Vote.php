<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'uid',
        'votable_id',
        'votable_type'
    ];

    /**
     * Get all of the models that own comments.
     */
    public function votable()
    {
        return $this->morphTo('votable');
    }

    /**
     * @return MorphOne
     */
    public function post()
    {
        return $this->morphOne(Post::class, 'votable');
    }

    /**
     * @return MorphOne
     */
    public function comment()
    {
        return $this->morphOne(PostComment::class, 'votable');
    }
}
