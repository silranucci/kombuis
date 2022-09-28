<?php

namespace App\Form;

use App\Enumerations\UnitOfMeasure;
use \Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('product', ) TODO - Can i use this to create a product and productItem object?
            ->add('name', TextType::class)
            ->add('brand', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('unitOfMeasure', UnitOfMeasureType::class) //TODO - UnitOfMeasure Enum Type
            ->add('useByDate', DateType::class)
            ->add('daysIsGoodAfterOpening', DateIntervalType::class,
                [
                    'with_years' => false,
                    'with_months' => false,
                ])
            ->add('openingDate', DateType::class)
            ->add('safetyStock', IntegerType::class);
    }
}