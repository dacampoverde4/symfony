<?php

namespace ShopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Intl\Locale;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

use ShopBundle\Form\Type\SalesOrderProductType;

class SalesOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('company', TextType::class, array(
				'label' => 'shop.db.company',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('lastName', TextType::class, array(
				'label' => 'shop.db.last_name',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('firstName', TextType::class, array(
				'label' => 'shop.db.first_name',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('email', EmailType::class, array(
				'label' => 'shop.db.email',
				'attr' => array('maxlength' => '255'),
				'required' => true
			))
			->add('phone', TextType::class, array(
				'label' => 'shop.db.phone',
				'attr' => array('maxlength' => '20'),
				'required' => true
			))
			->add('crn', TextType::class, array(
				'label' => 'shop.db.crn',
				'attr' => array('maxlength' => '20'),
				'required' => true
			))
			->add('address', TextType::class, array(
				'label' => 'shop.db.address',
				'attr' => array('maxlength' => '200'),
				'required' => true
			))
			->add('city', TextType::class, array(
				'label' => 'shop.db.city',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('zipCode', TextType::class, array(
				'label' => 'shop.db.zip_code',
				'attr' => array('maxlength' => '10'),
				'required' => false
			))
			->add('country', CountryType::class, array(
				'label' => 'shop.db.country',
				'placeholder' => 'contact_us.select',
				'choices' => array_flip(array_filter(Intl::getRegionBundle()->getCountryNames(), function($k) { return in_array($k, array('FR', 'ZA', 'AL', 'DZ', 'DE', 'AD', 'AR', 'AM', 'AU', 'AT', 'AZ', 'BD', 'BE', 'BO', 'BA', 'BR', 'BG', 'CL', 'CN', 'CY', 'CO', 'KR', 'CR', 'HR', 'CU', 'CW', 'SV', 'EC', 'ES', 'EE', 'VA', 'FJ', 'FI', 'GE', 'GI', 'GR', 'GL', 'GP', 'GT', 'GF', 'HT', 'HN', 'HU', 'IC', 'ID', 'IE', 'IS', 'IL', 'IT', 'RE', 'LT', 'LU', 'MK', 'MG', 'MY', 'MV', 'MT', 'MA', 'MQ', 'MU', 'MR', 'YT', 'MX', 'MD', 'MC', 'MN', 'ME', 'NO', 'PA', 'PY', 'NL', 'PE', 'PL', 'PF', 'PR', 'PT', 'RO', 'GB', 'RU', 'RS', 'SG', 'SK', 'SI', 'SE', 'CH', 'TW', 'CZ', 'TH', 'TN', 'TR', 'UA', 'UY', 'VE', 'VN')); }, ARRAY_FILTER_USE_KEY)),
				'choice_loader' => null,
				'preferred_choices' => array('FR'),
				'required' => true
			))
			->add('salesOrderProducts', CollectionType::class, array(
				'entry_type' => SalesOrderProductType::class
			))
			->add('recaptcha', EWZRecaptchaType::class, array(
				'language' => Locale::getDefault(),
				'attr' => array(
					'options' => array(
						'theme' => 'light',
						'type'  => 'image',
						'size' => 'invisible',
						'defer' => true,
						'async' => true,
						'callback' => 'onSubmit'
					 )
				)
			));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\SalesOrder'
        ));
    }

    public function getBlockPrefix()
    {
        return 'salesorder';
    }
}
