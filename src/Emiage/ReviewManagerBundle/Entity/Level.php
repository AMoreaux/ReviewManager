<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Level
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\LevelRepository")
 */
class Level
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
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Student", cascade={"persist"}, mappedBy="level")
     */
    protected $students;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Level
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
     * @return Level
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
}
