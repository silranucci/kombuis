<?php

namespace App\Form;

use App\Enumerations\UnitOfMeasure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnitOfMeasureType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'Gram' => UnitOfMeasure::GRAM,
                'Kilogram' => UnitOfMeasure::KILOGRAM,
                'Litre' => UnitOfMeasure::LITRE,
                'Millilitre' => UnitOfMeasure::MILLILITRE,
                'Unit' => UnitOfMeasure::UNITS,
            ]
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

}