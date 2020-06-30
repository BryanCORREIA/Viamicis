<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Comments;
use App\Form\AddArticlesType;
use App\Form\CommentsType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()->getRepository(Articles::Class)->findBy(['Valide'=>1],
            ['created_at'=>'desc']);
        $articles = $paginator->paginate(
          $donnees, //On passe les données articles
          $request->query->getInt('page', 1), //Numéro de la page en cours et sinon 1 par défault
          5 //Nombre d'lément par page
        );
        return $this->render('articles/index.html.twig', [
            'articles' => $articles

        ]);
    }

    /**
     * @Route("admin/articleAdministration", name="adminarticles")
     */
    public function administration(Request $request, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()->getRepository(Articles::Class)->findBy(['Valide'=>-1],
            ['created_at'=>'desc']);
        $articles = $paginator->paginate(
            $donnees, //On passe les données articles
            $request->query->getInt('page', 1), //Numéro de la page en cours et sinon 1 par défault
            5 //Nombre d'lément par page
        );
        return $this->render('articles/index.html.twig', [
            'articles' => $articles

        ]);
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/articles/nouveau", name="ajoutarticle")
     */
    public function ajoutArticle(Request $request){
        $article = New Articles();
        $form = $this->createForm(AddArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $article->setUsers($this->getUser());
            $article->setCreatedAt(new \DateTime('now'));
            $article->setValide(-1);
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($article);
            $doctrine->flush();
        }

        return $this->render('articles/ajout.html.twig', [
            'articleForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/articles/{id}", name="articlesId")
     */
    public function article($id, Request $request){
        // On récupère l'articles correspondant a l'id
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id' => $id]);
        if(!$article){
            // Si aucun articles n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('L\'articles n\'existe pas');
        }

        $commentaire = new Comments();

        $form = $this->createForm(CommentsType::class, $commentaire);

        //On récupère les données saisies
        $form->handleRequest($request);

        //On vérifie si le formulaire a été envoyé et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()){
            $commentaire->setArticles($article);
            $commentaire->setCreatedAt(new \DateTime('now'));
            $user = $this->getUser();
            $commentaire->setUsers($user);


            //On instancie formComment
            $doctinre = $this->getDoctrine()->getManager();

            //On hydrate $commentaire
            $doctinre->persist($commentaire);

            // On écrit dans la base de données
            $doctinre->flush();
        }

        // Si l'articles existe nous envoyons les données à la vue
        return $this->render('articles/article.html.twig', [
            'article'=> $article,
            'formComment' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/articles/{id}", name="adminArticlesId")
     */
    public function adminArticle($id, Request $request){
        // On récupère l'articles correspondant a l'id
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id' => $id]);
        if(!$article){
            // Si aucun articles n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('L\'articles n\'existe pas');
        }


        // Si l'articles existe nous envoyons les données à la vue
        return $this->render('articles/adminArticle.html.twig', [
            'article'=> $article,
        ]);
    }

    /**
     * @Route("/article/valider/{id}", name="adminArticlesValider")
     */
    public function adminArticlesValider($id, Request $request,  PaginatorInterface $paginator){
        // On récupère l'articles correspondant a l'id
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id' => $id]);
        if(!$article){
            // Si aucun articles n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('L\'articles n\'existe pas');
        }
        if ($article){
            $em = $this->getDoctrine()->getManager();
            $article->setValide(1);
            $em->persist($article);
            $em->flush();

        }

        $donnees = $this->getDoctrine()->getRepository(Articles::Class)->findBy(['Valide'=>1],
            ['created_at'=>'desc']);
        $articles = $paginator->paginate(
            $donnees, //On passe les données articles
            $request->query->getInt('page', 1), //Numéro de la page en cours et sinon 1 par défault
            5 //Nombre d'lément par page
        );
        return $this->render('articles/index.html.twig', [
            'articles' => $articles

        ]);
    }

    /**
     * @Route("/article/refuser/{id}", name="adminArticlesValider")
     */
    public function adminArticlesRefuser($id, Request $request,  PaginatorInterface $paginator){
        // On récupère l'articles correspondant a l'id
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id' => $id]);
        if(!$article){
            // Si aucun articles n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('L\'articles n\'existe pas');
        }
        if ($article){
            $em = $this->getDoctrine()->getManager();
            $article->setValide(0);
            $em->persist($article);
            $em->flush();

        }

        $donnees = $this->getDoctrine()->getRepository(Articles::Class)->findBy(['Valide'=>1],
            ['created_at'=>'desc']);
        $articles = $paginator->paginate(
            $donnees, //On passe les données articles
            $request->query->getInt('page', 1), //Numéro de la page en cours et sinon 1 par défault
            5 //Nombre d'lément par page
        );
        return $this->render('articles/index.html.twig', [
            'articles' => $articles

        ]);
    }


}
