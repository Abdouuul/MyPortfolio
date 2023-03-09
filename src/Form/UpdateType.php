<?php

namespace App\Form;

use App\Config\Types;
use App\Entity\Update;
use App\Repository\ProjectRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UpdateType extends AbstractType
{
    //This form is not used anymore 
    public function __construct(
        private ProjectRepository $projectRepository
    ) {
        $this->projectRepository = $projectRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('project', ChoiceType::class, [
                'label' => 'Project',
                'placeholder' => 'Choose a project',
                'choices' => $this->projectRepository->findall(),
                'choice_label' => 'name',
            ])
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('type', EnumType::class, [
                'label' => 'Type',
                'placeholder' => 'Choose a type',
                'class' => Types::class,                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Update::class
        ]);
    }
}
