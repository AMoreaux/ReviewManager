<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Emiage\UserBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationFormType extends BaseType
{

    private $class;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent :: buildForm ( $builder ,  $options );

        $builder
            ->add('roles', 'choice', array(
                    'label' => 'choisir un role',
                    'choices' => array(
                            'ROLE_ADMIN' => 'Administration',
                            'ROLE_PROF' => 'Professeur',
                            'ROLE_STUD' => 'étudiant'),
                    'multiple' => true));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'emiage_user_registration';
    }

    public function __construct($class, $roles_hierarchy = null)
    {
        $this->roles_hierarchy = $roles_hierarchy;
        $this->class = $class;
    }
}
