<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;
use App\Entity\Article;
use App\Repository\PostRepository;
use App\Repository\ArticleRepository;
use App\Form\LoginType;

/**
     * @Route("/post", name="post.")
     */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
      
        return $this->render('post/index.html.twig', [
          'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return response
     */
    // public function create(Request $request) {
    //    //new post Name
    //    $Post = new Post();
    //   $registration_form = $this->createForm(LoginType::class,$Post);

    //    //EntityManager
    //    $em = $this->getDoctrine()->getManager();

    //   //  $em->persist($Post);
    //   //  $em->flush();

    //    //return
    //    return $this->render('/registration.html.twig',[
    //      'regform' => $registration_form->createView()
    //    ]);
    // }

    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post){
      dump($post);
      die;
      return $this->render('post/show.html.twig',[
        'post'=> $post
      ]);
    }
    
    /**
     * @Route("/delete/{id}", name="delete")
     * @param Post $post
     * @return Response
     */
    public function remove(Post $post){
      $em = $this->getDoctrine()->getManager();
      $em->remove($post);
      $em->flush();
      $this->addFlash('success','Id deleted successfully');

      return $this->redirect($this->generateUrl('post.index'));

  }

  /**
   * @Route("/articles", name="articles")
   * @param ArticleRepository $Articlerepo
   * @return Response
   */
  public function articles(ArticleRepository $Articlerepo){

    $articles = $Articlerepo->findAll();

    return $this->render('post/article.html.twig',[
      'articles' => $articles
    ]);

  }
}
