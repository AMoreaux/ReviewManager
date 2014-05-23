<?php

namespace Emiage\ReviewManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emiage\ReviewManagerBundle\Entity\StudentRepository")
 */
class Student
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    protected $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    protected $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    protected $phone;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\Level", cascade={"persist"}, inversedBy="students")
	 */
    protected $level;

    /**
     * @ORM\ManyToOne(targetEntity="Emiage\ReviewManagerBundle\Entity\RegisterCenter", cascade={"persist"}, inversedBy="students")
     */
    protected $registerCenter;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\ReviewCenter", cascade={"persist"}, inversedBy="students")
     */
    protected $reviewsCenters;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Module", cascade={"persist"}, inversedBy="students")
     */
    protected $module;

    /**
     * @ORM\OneToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Note", cascade={"persist"}, mappedBy="student")
     */
    protected $notes;

    /**
     * @ORM\ManyToMany(targetEntity="Emiage\ReviewManagerBundle\Entity\Examen", cascade={"persist"}, inversedBy="students")
     */
    protected $examens;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reviewsCenters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->module = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Student
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
     * Set login
     *
     * @param string $login
     * @return Student
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Student
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Student
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set level
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Level $level
     * @return Student
     */
    public function setLevel(\Emiage\ReviewManagerBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \Emiage\ReviewManagerBundle\Entity\Level 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set registerCenter
     *
     * @param \Emiage\ReviewManagerBundle\Entity\RegisterCenter $registerCenter
     * @return Student
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
     * Add reviewsCenters
     *
     * @param \Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewsCenters
     * @return Student
     */
    public function addReviewsCenter(\Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewsCenters)
    {
        $this->reviewsCenters[] = $reviewsCenters;

        return $this;
    }

    /**
     * Remove reviewsCenters
     *
     * @param \Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewsCenters
     */
    public function removeReviewsCenter(\Emiage\ReviewManagerBundle\Entity\ReviewCenter $reviewsCenters)
    {
        $this->reviewsCenters->removeElement($reviewsCenters);
    }

    /**
     * Get reviewsCenters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReviewsCenters()
    {
        return $this->reviewsCenters;
    }

    /**
     * Add module
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $module
     * @return Student
     */
    public function addModule(\Emiage\ReviewManagerBundle\Entity\Module $module)
    {
        $this->module[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Module $module
     */
    public function removeModule(\Emiage\ReviewManagerBundle\Entity\Module $module)
    {
        $this->module->removeElement($module);
    }

    /**
     * Get module
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Add notes
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Note $notes
     * @return Student
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
     * Add examens
     *
     * @param \Emiage\ReviewManagerBundle\Entity\Examen $examens
     * @return Student
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
