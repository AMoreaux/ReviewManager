<?php

namespace Emiage\ReviewManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoteUploadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('note', 'text',  array(
                'required' => false,
                'attr'=>array('class'=>'hidden')
            ))
            ->add('student', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:Student',
                'property'=>'login',
                'multiple'=>false,
                'attr'=>array('class'=>'hidden')))
            ->add('module', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:Module',
                'property'=>'code',
                'multiple'=>false,
                'attr'=>array('class'=>'hidden')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emiage\ReviewManagerBundle\Entity\Note'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emiage_reviewmanagerbundle_note';
    }
}
