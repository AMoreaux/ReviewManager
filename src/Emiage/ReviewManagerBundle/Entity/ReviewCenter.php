<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReviewCenter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\ReviewCenterRepository")
 */
class ReviewCenter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Student", cascade={"persist"}, mappedBy="reviewsCenters")
     */
    protected $students;

    /**
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Examen", cascade={"persist"}, mappedBy="reviewCenter")
     */
    protected $examens;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examen = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return ReviewCenter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add students
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Student $students
     * @return ReviewCenter
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
     * Add examens
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Examen $examens
     * @return ReviewCenter
     */
    public function addExamen(\Emiage\ReviewManagerBundle\Entity\Examen $examens)
    {
        $this->examens[] = $examens;

        return $this;
    }

    /**
     * Remove examens
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Examen $examens
     */
    public function removeExamen(\Emiage\ReviewManagerBundle\Entity\Examen $examens)
    {
        $this->examens->removeElement($examens);
    }

    /**
     * Get examens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamens()
    {
        return $this->examens;
    }
}
