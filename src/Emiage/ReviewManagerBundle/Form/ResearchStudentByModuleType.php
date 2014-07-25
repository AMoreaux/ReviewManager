<?php

namespace Emiage\ReviewManagerBundle\Form;

use Emiage\ReviewManagerBundle\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResearchStudentByModuleType extends AbstractType
{

    public function __construct($id)
    {
        $this->id=$id;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id =$this->id;

        $builder
            ->add('student', 'entity', array(
                'class'=>'EmiageReviewManagerBundle:student',
                'property'=>'name',
                'empty_value' => 'Tous',
                'empty_data' => null,
                'multiple'=>false,
                'required'=>false,
                'query_builder' =>  function(\Doctrine\ORM\EntityRepository  $repository) use ($id)
                    {
                        return $repository->createQueryBuilder('s')
                            ->addSelect('m')
                            ->leftJoin('s.modules', 'm')
                            ->where('m.id= :id')
                            ->setParameter('id', $id);
                    },
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
        return 'researchstudent';
    }
}