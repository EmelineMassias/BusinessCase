<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Vetements;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class VetementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('prix')
            ->add('image', FileType::class, [
                'label' => 'Charger une image',
                'mapped' => false,
                "required" => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => "Le format de l'image n'est pas valide. Veuillez choisir un format jpeg ou png",
                    ])
                ],

            ])
            ->add('prestation', ChoiceType::class, [
                'choices' => [
                    'Nettoyage' => 'Nettoyage',
                    'Blanchisserie' => 'Blanchisserie',
                    'Détachage' => 'Détachage',
                    'Repassage' => 'Repassage',
                    'Parfum' => 'Parfum',
                    'Récupération et livraison à domicile' => 'Récupération et livraison à domicile',
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,

            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie',
                'choice_label' => 'libelle',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vetements::class,
        ]);
    }
}
