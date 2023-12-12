<?php

namespace ContactUsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Intl\Locale;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('purpose', EntityType::class, array(
                'class' => 'ContactUsBundle:Purpose',
				'label' => 'contact_us.db.purpose',
				'placeholder' => 'contact_us.select',
				'required' => true
			))
			->add('company', TextType::class, array(
				'label' => 'contact_us.db.company',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('activity', EntityType::class, array(
                'class' => 'ContactUsBundle:Activity',
				'label' => 'contact_us.db.activity',
				'placeholder' => 'contact_us.select',
				'required' => false
			))
			->add('gender', EntityType::class, array(
                'class' => 'ContactUsBundle:Gender',
				'label' => 'contact_us.db.gender',
				'expanded' => true,
				'multiple' => false,
				'required' => true
			))
			->add('lastName', TextType::class, array(
				'label' => 'contact_us.db.last_name',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('firstName', TextType::class, array(
				'label' => 'contact_us.db.first_name',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('email', EmailType::class, array(
				'label' => 'contact_us.db.email',
				'attr' => array('maxlength' => '255'),
				'required' => true
			))
			->add('phone', TextType::class, array(
				'label' => 'contact_us.db.phone',
				'attr' => array('maxlength' => '20'),
				'required' => true
			))
			->add('address', TextType::class, array(
				'label' => 'contact_us.db.address',
				'attr' => array('maxlength' => '200'),
				'required' => false
			))
			->add('city', TextType::class, array(
				'label' => 'contact_us.db.city',
				'attr' => array('maxlength' => '50'),
				'required' => true
			))
			->add('zipCode', TextType::class, array(
				'label' => 'contact_us.db.zip_code',
				'attr' => array('maxlength' => '10'),
				'required' => false
			))
			->add('country', CountryType::class, array(
				'label' => 'contact_us.db.country',
				'placeholder' => 'contact_us.select',
				'preferred_choices' => array('FR'),
				'required' => true
			))
			->add('productTypes', EntityType::class, array(
                'class' => 'ContactUsBundle:ProductType',
				'label' => 'contact_us.db.product_types',
				'expanded' => true,
				'multiple' => true,
				'required' => false,
				'query_builder' => function(EntityRepository $er) {
					return $er->createQueryBuilder('p')
						->where(((Locale::getDefault() === 'en') ? 'p.showEng' : 'p.showFra').' = ?1')->setParameter(1, true);
                },
			))
			->add('promotionsNews', ChoiceType::class, array(
				'label' => 'contact_us.db.promotions_news',
				'choices' => array('contact_us.yes' => true, 'contact_us.no' => false),
				'expanded' => true,
                'multiple' => false,
				'required' => true
			))
			->add('message', TextareaType::class, array(
				'label' => 'contact_us.db.message',
				'required' => true
			))
			->add('fileName1', TextType::class, array(
				'label' => 'contact_us.db.file_name_1',
				'attr' => array('maxlength' => '50'),
				'required' => false
			))
			->add('filePath1', FileType::class, array(
				'label' => 'contact_us.db.file_path_1',
				'required' => false,
				'attr' => array('accept' => 'application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/jpeg, image/png')
			))
			->add('fileName2', TextType::class, array(
				'label' => 'contact_us.db.file_name_2',
				'attr' => array('maxlength' => '50'),
				'required' => false
			))
			->add('filePath2', FileType::class, array(
				'label' => 'contact_us.db.file_path_2',
				'required' => false,
				'attr' => array('accept' => 'application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/jpeg, image/png')
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
            'data_class' => 'ContactUsBundle\Entity\Contact'
        ));
    }

    public function getBlockPrefix()
    {
        return 'contactus';
    }
}
