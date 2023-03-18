<?php

namespace App\Controller\Admin;

use App\Entity\Update;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class UpdateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Update::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('project'),
            TextField::new('name'),
            TextField::new('description'),
            ChoiceField::new('type', 'Update Type')
                ->setChoices([
                    'Update' => 'Update',
                    'Fix' => 'Fix',
                    'Modif' => 'Modif',
                    'Feature' => 'Feature'
                ]),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $update): void
    {
        if (!$update instanceof Update) return;

        parent::persistEntity($em, $update);
    }
}
