<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Note
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\NoteRepository")
 */
class Note
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
     * @ORM\Column(name="note", type="string", length=255)
     */
    protected $note;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\Student", cascade={"persist"}, inversedBy="notes")
     */
    protected $student;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\ReviewCenter", cascade={"persist"}, inversedBy="notes")
     */
    protected $reviewCenter;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\Module", cascade={"persist"}, inversedBy="notes")
     */
    protected $module;

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
     * Set note
     *
     * @param string $note
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set student
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Student $student
     * @return Note
     */
    public function setStudent(\Emiage\ReviewManagerBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \Emiage\ReviewManagerBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set reviewCenter
     *
     * @param \Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewCenter
     * @return Note
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

    /**
     * Set module
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $module
     * @return Note
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
