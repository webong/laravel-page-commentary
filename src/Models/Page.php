<?php
namespace CreativityKills\Commentary\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'commentary_pages';

    protected $guarded = [];

    /**
     * A page can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
