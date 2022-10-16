<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productItem', ProductItemType::class, [
                'label' => false
            ])
            ->add('product', ProductType::class, [
                'label' => false
            ]);
    }
}