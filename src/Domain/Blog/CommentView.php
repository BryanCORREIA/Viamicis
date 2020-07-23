<?php

namespace App\Domain\Blog;

use App\Entity\Comments;

class CommentView
{
    public $id;

    public $creator;

    public $content;

    public $createdAt;

    public static function build(Comments $comment) {
        $view = new self();

        $view->id           = $comment->getId();
        $view->content      = $comment->getContent();
        $view->createdAt    = $comment->getCreatedAt();
        $view->creator      = $comment->getUsers();

        return $view;
    }
}
