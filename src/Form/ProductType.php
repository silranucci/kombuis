<?php

namespace App\Form;

use App\Entity\Product;
use App\Enum\UnitOfMeasure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('product', ) TODO - Can i use this to create a product and productItem object?
            ->add('barCode', null, [
                'label' => 'Barcode',
            ])
            ->add('name', null, [
                'label' => 'Name',
            ])
            ->add('brand', null, [
                'label' => 'Brand',
            ])
            ->add('unitOfMeasure', UnitOfMeasureType::class, [
                'label' => 'Unit of measure'
            ])
            ->add('daysIsGoodAfterOpening', DateIntervalType::class,
                [
                    'labels' => [
                        'days' => 'Days is good after opening'
                    ],
                    'label' => false,
                    'with_years' => false,
                    'with_months' => false,
                ])
            ->add('safetyStock', IntegerType::class, [
                'label' => 'Safety stock',
                'attr' => [
                    'min' => 0
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }


}