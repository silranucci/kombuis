<?php

namespace App\Form;

use App\Entity\Product;
use App\Enum\UnitOfMeasure;
use Symfony\Component\Form\AbstractType;
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
                'label' => false,
                'attr' => [
                    'placeholder' => 'enter the barcode'
                ]
            ])
            ->add('name', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'enter the name of the product'
                ]
            ])
            ->add('brand', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'enter the brand name'
                ]
            ])
            ->add('unitOfMeasure', UnitOfMeasureType::class, [
                'label' => false
            ])
            ->add('daysIsGoodAfterOpening', null,
                [
                    'label' => false,
                    'with_years' => false,
                    'with_months' => false,
                    'attr' => [
                        'placeholder' => 'enter the period after opening'
                    ]
                ])
            ->add('safetyStock', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'placeholder' => 'enter the safety stock amount'
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