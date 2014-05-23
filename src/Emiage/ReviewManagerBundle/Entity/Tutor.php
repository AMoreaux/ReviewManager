<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tutor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\TutorRepository")
 */
class Tutor
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
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\User", cascade={"persist"}, inversedBy="tutors")
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
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \Emiage\ReviewManagerBundle\Entity\User $user
     * @return Tutor
     */
    public function setUser(\Emiage\ReviewManagerBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Emiage\ReviewManagerBundle\Entity\User 
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
}
