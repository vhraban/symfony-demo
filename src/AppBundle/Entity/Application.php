<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="application")
 * @ORM\HasLifecycleCallbacks
 */
class Application
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string Name of the application
     * @Assert\NotBlank(message="Name can not be blank")
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string Sex
     * @Assert\NotBlank(message="Sex can not be blank")
     * @ORM\Column(name="sex", type="string", length=6)
     */
    protected $sex;

    /**
     * @var int Age
     * @Assert\NotBlank(message="Age can not be blank")
     * @ORM\Column(name="age", type="integer")
     */
    protected $age;

    /**
     * @var string Country
     * @Assert\NotBlank(message="Country can not be blank")
     * @ORM\Column(name="country", type="string", length=255)
     */
    protected $country;

    /**
     * @var array A list of allowed values for sex field
     */
    static $allowedSex = ["male", "female"];

    /**
     * @var DateTime Time created
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param string $name Name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set the sex
     *
     * @param string $sex Sex
     *
     * @return $this
     */
    public function setSex($sex)
    {
        if(!in_array($sex, static::$allowedSex))
        {
            throw new UnexpectedValueException("{$sex} is not allowed sex");
        }

        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the age
     *
     * @param int $age
     *
     * @return $this
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the country
     *
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get created at
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set created at
     *
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get ID
     *
     * @return int The ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param int $id ID to set
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->setCreatedAt(new DateTime("now"));
    }


}
