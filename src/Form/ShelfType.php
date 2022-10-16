<?php

namespace App\Form;

use App\Entity\Furniture;
use App\Entity\Shelf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShelfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shelfNumber')
            ->add('furniture', FurnitureType::class, [
                'label' => 'Furniture name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Shelf::class
        ]);
    }

}