<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
       return $this->render('home/index.html.twig');
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
     */
    public function registration(){
        return $this->render('/home/registration.html.twig');
    }
}
