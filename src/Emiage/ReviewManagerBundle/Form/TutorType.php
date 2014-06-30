<?php

namespace Emiage\ReviewManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TutorType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', 'entity', array(
            'class'=>'EmiageUserBundle:User',
            'property'=>'username',
            'multiple'=>false,))
            ->add('modules', 'entity', array(
            'class'=>'EmiageReviewManagerBundle:Module',
            'property'=>'code',
            'multiple'=>true,))
            ->add('registerCenter', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:RegisterCenter',
                'property'=>'name',))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emiage\ReviewManagerBundle\Entity\Tutor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emiage_reviewmanagerbundle_tutor';
    }
}
