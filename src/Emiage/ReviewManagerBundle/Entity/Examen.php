<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\ExamenRepository")
 */
class Examen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="realizedOn", type="datetime")
     */
    private $realizedOn;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Student", cascade={"persist"}, inversedBy="examens")
     */
    protected $students;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\Module", cascade={"persist"}, inversedBy="examens")
     */
    protected $module;

    /**
     * @ORM\ManyToOne (targetEntity="Emiage\ReviewManagerBundle\Entity\ReviewCenter", cascade={"persist"}, inversedBy="examens")
     */
    protected $reviewCenter;


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
     * Set realizedOn
     *
     * @param \DateTime $realizedOn
     * @return Examen
     */
    public function setRealizedOn($realizedOn)
    {
        $this->realizedOn = $realizedOn;

        return $this;
    }

    /**
     * Get realizedOn
     *
     * @return \DateTime 
     */
    public function getRealizedOn()
    {
        return $this->realizedOn;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add students
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Student $students
     * @return Examen
     */
    public function addStudent(\Emiage\ReviewManagerBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Student $students
     */
    public function removeStudent(\Emiage\ReviewManagerBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set module
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $module
     * @return Examen
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
     * Set reviewCenter
     *
     * @param \Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewCenter
     * @return Examen
     */
    public function setReviewCenter(\Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewCenter = null)
    {
        $this->reviewCenter = $reviewCenter;

        return $this;
    }

    /**
     * Get reviewCenter
     *
     * @return \Emiage\ReviewManagerBundle\Entity\ReviewCenter 
     */
    public function getReviewCenter()
    {
        return $this->reviewCenter;
    }
}