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
            ->add('firstname')
            ->add('lastname')
            ->add('login')
            ->add('mail')
            ->add('phone')
            ->add('level', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:level',
                'property'=>'name',
                'multiple'=>false,))
            ->add('registerCenter', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:registerCenter',
                'property'=>'name',
                'multiple'=>false,))
            ->add('reviewsCenters', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:reviewCenter',
                'property'=>'name',
                'multiple'=>true,))
            ->add('modules', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:module',
                'property'=>'name',
                'multiple'=>true,))
            ->add('examens', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:examen',
                'property'=>'id',
                'multiple'=>false,
                'required' => false,
                'attr'=>array('class'=>'hidden')));
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
