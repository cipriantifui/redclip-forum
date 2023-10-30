<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
