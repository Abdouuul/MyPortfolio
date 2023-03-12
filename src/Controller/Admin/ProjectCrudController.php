<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('description'),
            TextField::new('gitlink'),
            DateField::new('startDate'),
            DateField::new('endDate'),
            ImageField::new('uploadedFiles', 'Add Images')
                ->hideOnIndex()
                ->setBasePath('uploads/projectsImages')
                ->setUploadDir('public/uploads/projectImages')
                ->setFormTypeOption('multiple', true)
                ->setUploadedFileNamePattern('[slug].[extension]')

        ];
    }
}
