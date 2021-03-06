<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_likes';
    public $timestamps = false;

    public function getComment()
    {
        return Comment::find($this->comment_id);
    }
}
