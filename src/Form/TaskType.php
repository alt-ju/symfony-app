<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 150]),
                    new Assert\NotBlank()
                ], 
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description', 
                'attr' => [
                    'cols' => 10,
                    'rows' => 5
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'A faire' => 'A faire',
                    'En cours' => 'En cours',
                    'Terminée' => 'Terminée'
                ], 
                'label' => 'Statut'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
