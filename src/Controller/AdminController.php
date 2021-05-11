<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
/**
     * @Route("/admin", name="admin.")
     */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param ArticleRepository $ArticleRepository
     */
    public function admin(ArticleRepository $ArticleRepository)
    {
        // $Article = new Article();
        // $articleform = $this->createForm(ArticleType::class,$Article);

        // $articleform->handleRequest($request);
        // if($articleform->isSubmitted()){

        //     $em = $this->getDoctrine()->getManager();
        //     $file = $request->files->get('article')['attachment'];
        //     /**@var Uploadedfile $file */
        //     if($file){
        //         $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
        //         $file->move(
        //             $this->getParameter('uploads_dir'),
        //             $filename
        //         );
        //         $Article ->setImage($filename);
        //     }
        //     $em ->persist($Article);
        //     $em ->flush();

        //     return $this->redirect($this->generateUrl('post.articles'));
            
        // }

        $articles = $ArticleRepository->findAll();
        return $this->render('admin/index.html.twig',[
            'articles' => $articles
        ]);
    }
    
    /**
     * @Route ("/post_articles",name="post_articles")
     * @param Request $request
     * @return Response
     */
    public function show(Request $request){
         $Article = new Article();
         $articleform = $this->createForm(ArticleType::class,$Article);

         $articleform->handleRequest($request);
         if($articleform->isSubmitted()){

             $em = $this->getDoctrine()->getManager();
             $file = $request->files->get('article')['Attachment'];
             /**@var Uploadedfile $file */
             if($file){
                 $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                 $file->move(
                     $this->getParameter('uploads_dir'),
                     $filename
                 );
                 $Article ->setImage($filename);
             }
             $em ->persist($Article);
             $em ->flush();

             return $this->redirect($this->generateUrl('admin.index'));
            
         }
         return $this->render('admin/post_articles.html.twig',[
            'articleform' => $articleform->createView()
        ]);


    }
}
