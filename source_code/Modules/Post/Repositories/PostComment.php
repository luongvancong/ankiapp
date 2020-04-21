<?php

namespace Modules\Post\Repositories;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model {
    protected $table = 'post_comments';

    public function getUserAvatar() {
        return PATH_STATIC . 'uploads/thumbs/big/' . $this->user_avatar;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function getComment() {
        $comment = $this->comment;

        $comment = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<span>$2</span>", $comment);

        return $comment;
    }
}