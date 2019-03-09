<?php
namespace CreativityKills\Commentary\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'commentary_comments';

    protected $guarded = [];

    /**
     * Return user the comment belongs to.
     *
     * @return array
     */
    public function commentator()
    {
        return $this->belongsTo(config('commentary.user_model'), 'user_id');
    }
}
