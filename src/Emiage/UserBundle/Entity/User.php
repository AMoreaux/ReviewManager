<?php

namespace Emiage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Module", cascade={"persist"}, mappedBy="responsable")
     */
    protected  $module;

    /**
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Tutor", cascade={"persist"}, mappedBy="user")
     */
    protected $tutors;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tutors = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set module
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $module
     * @return User
     */
    public function setModule(\Emiage\ReviewManagerBundle\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Emiage\ReviewManagerBundle\Entity\Module 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Add tutors
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Tutor $tutors
     * @return User
     */
    public function addTutor(\Emiage\ReviewManagerBundle\Entity\Tutor $tutors)
    {
        $this->tutors[] = $tutors;

        return $this;
    }

    /**
     * Remove tutors
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Tutor $tutors
     */
    public function removeTutor(\Emiage\ReviewManagerBundle\Entity\Tutor $tutors)
    {
        $this->tutors->removeElement($tutors);
    }

    /**
     * Get tutors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTutors()
    {
        return $this->tutors;
    }
}
