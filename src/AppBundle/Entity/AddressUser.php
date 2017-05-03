<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 21:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressUserRepository")
 * @ORM\Entity
 * @ORM\Table(name="address_user")
 */
class AddressUser
{

    /**
     * @ORM\Column(name="address_user_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    private $address_user_id;

    /**
     * @ORM\Column(name="city",type="string", length=25)
     * @Assert\NotNull(message="Miasto nie może być pusty")
     * @Assert\NotBlank(message="Miasto nie może być pusty")
     */
    private $city;

    /**
     * @ORM\Column(name="country",type="string", length=25)
     * @Assert\NotNull(message="Kraj nie może być pusty")
     * @Assert\NotBlank(message="Kraj nie może być pusty")
     */
    private $country;

    /**
     * @ORM\Column(name="home_nr",type="string", length=25)
     * @Assert\NotNull(message="Nr domu nie może być pusty")
     * @Assert\NotBlank(message="Nr domu nie może być pusty")
     */
    private $home_nr;

    /**
     * @ORM\Column(name="post_code",type="string", length=25)
     * @Assert\NotNull(message="Adres pocztowy nie może być pusty")
     * @Assert\NotBlank(message="Adres pocztowy nie może być pusty")
     */
    private $post_code;

    /**
     * @ORM\Column(name="street",type="string", length=25)
     * @Assert\NotNull(message="Ulica nie może być pusty")
     * @Assert\NotBlank(message="Ulica nie może być pusty")
     */
    private $street;


    /**
     * Get addressUserId
     *
     * @return integer
     */
    public function getAddressUserId()
    {
        return $this->address_user_id;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return AddressUser
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return AddressUser
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set homeNr
     *
     * @param string $homeNr
     *
     * @return AddressUser
     */
    public function setHomeNr($homeNr)
    {
        $this->home_nr = $homeNr;

        return $this;
    }

    /**
     * Get homeNr
     *
     * @return string
     */
    public function getHomeNr()
    {
        return $this->home_nr;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     *
     * @return AddressUser
     */
    public function setPostCode($postCode)
    {
        $this->post_code = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string
     */
    public function getPostCode()
    {
        return $this->post_code;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return AddressUser
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }
}
