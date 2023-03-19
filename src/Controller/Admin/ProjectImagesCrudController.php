<?php

namespace App\Controller\Admin;

use App\Entity\ProjectImages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectImages::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('path')->onlyOnIndex(),
            ImageField::new('path')->onlyOnIndex(),
            AssociationField::new('project'),
            ImageField::new('uploadedFile', 'Add Images')
                ->hideOnIndex()
                ->setBasePath('uploads/projectsImages')
                ->setUploadDir('public/uploads/projectImages')
                ->setFormTypeOption('multiple', false)
                ->setUploadedFileNamePattern('[slug].[extension]'),
        ];
    }
}
