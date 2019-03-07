<?php
namespace CreativityKills\Commentary\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    /**
     * Return who the comment belongs to.
     *
     * @return array
     */
    public function commentator()
    {
        return $this->belongsTo(config('commentary.user_model'), 'user_id');
    }

    /**
     * Return all comments for this model.
     *
     * @return array
     */
    public function thread()
    {
        return $this->hasMany(config('commentary.comment_model'), 'parent_id');
    }
}
