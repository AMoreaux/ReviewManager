<?php

namespace Emiage\ReviewManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExamenType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('realizedOn', 'date', array(
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy',
                'attr' => array('type' => 'date'),
            ))
            ->add('module', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:module',
                'property'=>'name',))
            ->add('reviewCenter', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:ReviewCenter',
                'property'=>'name',))
        ;
    }


    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emiage\ReviewManagerBundle\Entity\Examen'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emiage_reviewmanagerbundle_examen';
    }
}
