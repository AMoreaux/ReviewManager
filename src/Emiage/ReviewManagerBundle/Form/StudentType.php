<?php

namespace Emiage\ReviewManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',  'text')
            ->add('login',  'text')
            ->add('mail',   'text')
            ->add('phone', 'text')
            ->add('level', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:Level',
                'property'=>'name',
                'multiple'=>false,))
            ->add('registerCenter', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:RegisterCenter',
                'property'=>'name',
                'multiple'=>false,))
            ->add('reviewsCenters', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:ReviewCenter',
                'property'=>'name',
                'multiple'=>true,))
            ->add('modules', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:module',
                'property'=>'name',
                'multiple'=>true,))
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emiage\ReviewManagerBundle\Entity\Student'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emiage_reviewmanagerbundle_student';
    }
}
