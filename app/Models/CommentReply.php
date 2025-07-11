<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $guarded = [];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
