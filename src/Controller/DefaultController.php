<?php

namespace App\Controller;

use App\Domain\Api\Trip\TripView;
use App\Domain\Blog\ArticleView;
use App\Entity\Articles;
use App\Entity\Trip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $ourSelectionView = [];

        $article = $em->getRepository(Articles::class)->findOneBy(['valide' => 1], ['created_at' => 'DESC']);
        $article = ArticleView::build($article);

        $selection = $em->getRepository(Trip::class)->findBy(['enabled' => 1], ['createdAt' => 'DESC'], 3);
        foreach ($selection as $select) {
            $ourSelectionView[] = TripView::build($select, $this->getUser());
        }

        return $this->render('default/index.html.twig', [
            'selection'     => $ourSelectionView,
            'article'       => $article
        ]);
    }

    public function cgu() {
        return $this->render('default/cgu.html.twig');
    }

    public function ml() {
        return $this->render('default/ml.html.twig');
    }

    public function pdc() {
        return $this->render('default/politique.html.twig');
    }
}
