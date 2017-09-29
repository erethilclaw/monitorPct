<?php

namespace PctmonBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PctmonBundle\Entity\Destinatari;
use PctmonBundle\Entity\Site;


class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $site = $builder->getData();

        $builder
        ->add('url',TextType::class, array('label' => 'url'))
        ->add('text',TextType::class, array('label' => 'text'))
        ->add('nota',TextType::class, array('label' => 'nota'))


        ->add('destinataris',CollectionType::class, [
                    'entry_type' => EntityType::class,
                    'entry_options' => [
                        'class' => Destinatari::class,
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                'allow_extra_fields' => true,
            'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => Site::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'site';
    }
}
