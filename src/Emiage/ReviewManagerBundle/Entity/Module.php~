<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Module
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    protected $code;

    /**
     * @ORM\OneToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\User", cascade={"persist"}, mappedBy="module")
     */
    protected $responsable;

    /**
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Note", cascade={"persist"}, mappedBy="module")
     */
    protected $notes;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Tutor", cascade={"persist"}, mappedBy="modules")
     */
    protected $tutors;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Student", cascade={"persist"}, inversedBy="modules")
     */
    protected $students;

    /**
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Examen", cascade={"persist"}, mappedBy="module")
     */
    protected $examens;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tutors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examens = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Module
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
     * Set code
     *
     * @param string $code
     * @return Module
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set responsable
     *
     * @param \Emiage\ReviewManagerBundle\Entity\User $responsable
     * @return Module
     */
    public function setResponsable(\Emiage\ReviewManagerBundle\Entity\User $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \Emiage\ReviewManagerBundle\Entity\User 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Add notes
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Note $notes
     * @return Module
     */
    public function addNote(\Emiage\ReviewManagerBundle\Entity\Note $notes)
    {
        $this->notes[] = $notes;

        return $this;
    }

    /**
     * Remove notes
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Note $notes
     */
    public function removeNote(\Emiage\ReviewManagerBundle\Entity\Note $notes)
    {
        $this->notes->removeElement($notes);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Add tutors
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Tutor $tutors
     * @return Module
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
     * Add students
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Student $students
     * @return Module
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
     * @return Module
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
