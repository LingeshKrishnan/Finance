<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\LoginType;
use App\Form\UserLoginType;
use App\Form\ContactType;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $contact_form = $this->createForm(ContactType::class);
       return $this->render('home/index.html.twig',[
           'contactform' => $contact_form->createView()
       ]);
    }

    /**
     * @Route("/page/{name?}", name="page")
     * @param Request $request
     * @return Response
     */
    public function page(Request $request){
        $name = $request->get('name');
        return $this->render('home/page.html.twig',[
            'name' => $name,
        ]);
    }
    
    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @return Response 
     */
    public function registration(Request $request){
          //new post Name
          $Post = new Post();
          $registration_form = $this->createForm(LoginType::class,$Post);
          $login_form = $this->createForm(UserLoginType::class,$Post);

          $registration_form->handleRequest($request);
          if($registration_form->isSubmitted()){
               //EntityManager
           $em = $this->getDoctrine()->getManager();
    
            $em->persist($Post);
            $em->flush();
            return $this->redirect($this->generateUrl('post.index'));
          }
    
           $login_form->handleRequest($request);
           if($login_form->isSubmitted()){
            $DatabaseEm1 = $this->getDoctrine()->getManager('aathiran_fin_2021');
            
           }
    
           //return
           return $this->render('home/registration.html.twig',[
             'regform' => $registration_form->createView(),
             'loginform' => $login_form->createView()
           ]);
    }

    
}
