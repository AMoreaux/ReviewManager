<?php

namespace Emiage\ReviewManagerBundle\Form;

use Emiage\UserBundle\Entity\User;
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
            ->add('responsable', 'entity', array(
                'class'=>'EmiageUserBundle:User',
                'property'=>'username',
                'query_builder' =>  function(\Doctrine\ORM\EntityRepository $repository)
                    {
                        return $repository->createQueryBuilder('u')
                            ->where("u.roles LIKE '%ROLE_PROF%'");
                    },
                'multiple'=>false,))
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
