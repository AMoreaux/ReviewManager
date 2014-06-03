<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Emiage\UserBundle\Entity\User as BaseUser;

/**
 * Tutor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\TutorRepository")
 */
class Tutor extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\UserBundle\Entity\User", cascade={"persist"}, inversedBy="tutors")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Module", cascade={"persist"}, inversedBy="tutors")
     */
    protected $modules;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\RegisterCenter", cascade={"persist"}, inversedBy="tutors")
     */
    protected $registerCenter;


    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected  $tutors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tutors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \Emiage\UserBundle\Entity\User $user
     * @return Tutor
     */
    public function setUser(\Emiage\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Emiage\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add modules
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $modules
     * @return Tutor
     */
    public function addModule(\Emiage\ReviewManagerBundle\Entity\Module $modules)
    {
        $this->modules[] = $modules;

        return $this;
    }

    /**
     * Remove modules
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $modules
     */
    public function removeModule(\Emiage\ReviewManagerBundle\Entity\Module $modules)
    {
        $this->modules->removeElement($modules);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Set registerCenter
     *
     * @param \Emiage\ReviewManagerBundle\Entity\RegisterCenter $registerCenter
     * @return Tutor
     */
    public function setRegisterCenter(\Emiage\ReviewManagerBundle\Entity\RegisterCenter $registerCenter = null)
    {
        $this->registerCenter = $registerCenter;

        return $this;
    }

    /**
     * Get registerCenter
     *
     * @return \Emiage\ReviewManagerBundle\Entity\RegisterCenter 
     */
    public function getRegisterCenter()
    {
        return $this->registerCenter;
    }

    /**
     * Add tutors
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Tutor $tutors
     * @return Tutor
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
    /**
     * @var \Emiage\ReviewManagerBundle\Entity\Module
     */
    protected $module;


    /**
     * Set module
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $module
     * @return Tutor
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
}
