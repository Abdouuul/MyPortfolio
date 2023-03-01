<?php 

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void 
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Project name',
                'required' => 'true',
            ])
            ->add('description', TextType::class, [
                'label' => 'Project Description',
            ])
            ->add('gitlink', TextType::class, [
                'label' => 'Project github link',
                'required' => 'false'                
            ])
            ->add('startDate', DateType::class, [
                'label' => 'Start Date',
                'widget' => 'single_text',
            ])
            ->add('endDate', DateType::class, [
                'label' => 'End Date',
                'widget' => 'single_text',
            ])
            ->add('uploadedFiles', FileType::class, [
                'label' => 'Add Images',
                'data_class' => null,   
                'multiple' => 'true',             
                'constraints' => [
                    new All([
                        new File ([
                            'maxSize' => '2m',                            
                            'mimeTypes' => [
                                'image/jpg',
                                'image/jpeg',
                                'image/png'
                            ],
                                                      
                        ])
                    ])
                ],            
            ])

        ;            
    } 

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}