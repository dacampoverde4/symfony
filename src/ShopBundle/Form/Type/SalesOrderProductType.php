<?php

namespace ShopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SalesOrderProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('quantity', IntegerType::class, array(
				'label' => 'shop.db.quantity',
				'attr' => array('min' => 0),
				'required' => false
			));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\SalesOrderProduct'
        ));
    }

    public function getBlockPrefix()
    {
        return 'salesorderproduct';
    }
}
