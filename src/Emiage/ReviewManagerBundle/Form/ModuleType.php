<?php

namespace Emiage\ReviewManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('responsable')
            ->add('file')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emiage\ReviewManagerBundle\Entity\Module'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emiage_reviewmanagerbundle_module';
    }
}
