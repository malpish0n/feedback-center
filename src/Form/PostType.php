<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('title')
        ->add('description')
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Bug' => 'bug',
                'Solution' => 'solution',
                'Proposal' => 'proposal',
                'Feedback' => 'feedback',
            ],
            'placeholder' => 'Choose a type',
        ])
        ->add('tags');
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
