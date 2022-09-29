<?php

namespace App\Form;

use App\Entity\Product;
use App\Enumerations\UnitOfMeasure;
use \Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('product', ) TODO - Can i use this to create a product and productItem object?
            ->add('name')
            ->add('brand')
            ->add('unitOfMeasure', UnitOfMeasureType::class)
            ->add('daysIsGoodAfterOpening', null,
                [
                    'with_years' => false,
                    'with_months' => false,
                ])
            ->add('safetyStock', null, [
                'label' => 'Set the minimum amount that you want to have in your pantry'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }


}