<?php

namespace App\Controller;

use App\Domain\Blog\ArticleView;
use App\Entity\Articles;
use App\Form\AddArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BlogController extends AbstractController
{
    public function index()
    {
        return $this->render('blog/index.html.twig');
    }

    public function addArticle(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->getUser()) {
            return $this->json('false');
        }

        $title = $request->request->get('title');
        $content = $request->request->get('content');

        $article = New Articles();
        $article->setUsers($this->getUser());
        $article->setTitle($title);
        $article->setContent($content);

        $em->persist($article);
        $em->flush();

        return $this->json('true');
    }

    public function getArticles() {
        $isAdmin = false;
        $em = $this->getDoctrine()->getManager();

        if ($this->getUser()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $isAdmin = true;
            }
        }

        if ($isAdmin) {
            $articles = $em->getRepository(Articles::class)->findBy([], ['created_at' => 'ASC']);
        } else {
            $articles = $em->getRepository(Articles::class)->findBy(['valide' => 1], ['created_at' => 'ASC']);
        }

        $articlesView = [];
        foreach ($articles as $article) {
            $articlesView[] = ArticleView::build($article);
        }

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $articlesView = $serializer->serialize($articlesView, 'json');

        return $this->json($articlesView);
    }

    public function getArticle($slug) {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository(Articles::class)->findOneBy(['slug' => $slug]);

        $article = ArticleView::build($article);

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $article = $serializer->serialize($article, 'json');

        return $this->json($article);
    }
}
