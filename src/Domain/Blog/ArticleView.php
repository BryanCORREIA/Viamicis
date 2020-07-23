<?php

namespace App\Domain\Blog;

use App\Domain\User\UserAction;
use App\Entity\Articles;

class ArticleView
{
    public $id;

    public $title;

    public $content;

    public $createdAt;

    public $valide;

    public $creator;

    public $illustration;

    public $slug;

    public $comments = [];

    public static function build(Articles $article) {
        $view = new self();

        $view->title        = $article->getTitle();
        $view->content      = $article->getContent();
        $view->createdAt    = $article->getCreatedAt()->format('d - m - Y');
        $view->valide       = $article->getValide();
        $view->creator      = UserAction::build($article->getUsers());
        $view->illustration = $article->getIllustration();
        $view->slug         = $article->getSlug();

        foreach ($article->getComments() as $comment) {
            $comments[] = CommentView::build($comment);
        }

        return $view;
    }
}
