<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;
use App\Repository\PostRepository;

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
    public function create(Request $request) {
       //new post Name
       $Post = new Post();

       $Post -> setName('Lingesh');

       //EntityManager
       $em = $this->getDoctrine()->getManager();

       $em->persist($Post);
       $em->flush();

       //return
       return new Response('Name Inserted');
    }
}
