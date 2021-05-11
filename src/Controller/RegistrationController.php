<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
     * @Route("/register", name="register.")
     */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param UserPassowrdEncoderInterface $UserPasswordEncoder
     */
    public function register(Request $request, UserPasswordEncoderInterface $UserPasswordEncoder)
    {
        
        $reg_form = $this->createFormBuilder()

            ->add('username')
            ->add('password',RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password']
            ])
            ->add('Register',SubmitType::class,[
                'attr' => [
                    'class'=> 'btn btn-lg btn-success float-right'
                ]
            ])
            ->getForm()
            ;
                    
            $reg_form->handleRequest($request);
            if($reg_form->isSubmitted()) {
                $user = new User();
                $data = $reg_form->getData();
                $user ->setUsername($data['username']);
                $user->setPassword(
                    $UserPasswordEncoder->encodePassword($user,$data['password'])
                );
                dump($user);
                $em = $this->getDoctrine()->getManager();
                $em -> persist($user);
                $em ->flush();
                return $this->redirect($this->generateUrl('app_login'));
            }
            return $this->render('registration/index.html.twig', [
                'reg_form' => $reg_form->createView()
        ]);
    }
}
