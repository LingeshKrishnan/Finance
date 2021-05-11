<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Authorname')
            ->add('Title')
            ->add('Article')
            ->add('Attachment',FileType::class,[
                'mapped' => false
            ])
            ->add('Category',EntityType::class,[
                'class' => Category::class
            ])
            ->add('Contact')
            ->add('Post',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-lg btn-success float-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
