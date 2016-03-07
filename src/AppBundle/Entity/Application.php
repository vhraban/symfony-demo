<?php
namespace AppBundle\Entity;

use Doctrine\Common\Proxy\Exception\UnexpectedValueException;

class Application
{
    /**
     * @var string Name of the application
     */
    protected $name;

    /**
     * @var string Sex
     */
    protected $sex;

    /**
     * @var int Age
     */
    protected $age;

    /**
     * @var string Country
     */
    protected $country;

    /**
     * @var array A list of allowd values for sex field
     */
    static $allowedSex = ["male", "female"];

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
}
