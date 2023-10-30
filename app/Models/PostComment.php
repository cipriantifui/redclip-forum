<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'post_id',
        'user_id',
        'uid',
        'content',
        'is_published'
    ];

    protected $appends = ['votes_count'];

    protected $with = [
        'user',
        'votes',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return int
     */
    public function getVotesCountAttribute()
    {
        return $this->votes()->count();
    }

    /**
    * Get all of the comments votes
    */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
