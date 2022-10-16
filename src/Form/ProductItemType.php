<?php

namespace App\Form;

use App\Entity\ProductItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('useByDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('openingDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Opening Date'
            ])
            ->add('quantity', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('shelf', ShelfType::class, [
                'label' => 'Location Info'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductItem::class
        ]);
    }


}