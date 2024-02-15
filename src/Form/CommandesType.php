<?php

namespace App\Form;

use App\Entity\Commandes;
use App\Entity\vetements;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('detail')
            ->add('total')
            ->add('vetements_id', EntityType::class, [
                'class' => vetements::class,
'choice_label' => 'libelle',
'multiple' => true,
            ])

        ->add('statut', ChoiceType::class, [
            'choices' => [
                'non traitée' => 'Non traitée',
                'en cours' => 'En cours',
                'terminée' => 'Terminée',
                'livrée' =>'Livrée',
            ],
                'expanded' => true,
                'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
        ]);
    }
}
