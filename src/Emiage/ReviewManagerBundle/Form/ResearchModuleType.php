<?php

namespace Emiage\ReviewManagerBundle\Form;

use Emiage\ReviewManagerBundle\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResearchModuleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('module', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:Module',
                'property'=>'codename',
                'empty_value' => 'Tous',
                'empty_data' => null,
                'multiple'=>false,
                'required'=>false,
            ))
            ->add('search', 'submit', array(
                'label'=>'rechercher',
            ))
            ->setMethod('GET')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'researchmodule';
    }
}
