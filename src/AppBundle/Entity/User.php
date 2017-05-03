<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
{

    /**
     * @ORM\Column(name="user_id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $user_id;

    /**
     * @ORM\Column(name="active", type="boolean", options={"default"=0})
     */
    protected $active;

    /**
     * @ORM\Column(name="email",type="string", length=25, unique=true)
     * @Assert\NotNull(message="Email nie może być pusty")
     * @Assert\NotBlank(message="Email nie może być pusty")
     * @Assert\Email(
     *     message = "Email '{{ value }}' nie jest poprawny.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @ORM\Column(name="firstname",type="string", length=25)
     * @Assert\NotNull(message="Imie nie może być pusty")
     * @Assert\NotBlank(message="Imie nie może być pusty")
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname",type="string", length=25)
     * @Assert\NotNull(message="Nazwisko nie może być pusty")
     * @Assert\NotBlank(message="Nazwisko nie może być pusty")
     */
    protected $lastname;

    /**
     * @ORM\Column(name="password",type="string", length=64)
     * @Assert\NotNull(message="Haslo nie może być pusty")
     * @Assert\NotBlank(message="Haslo nie może być pusty")
     */
    protected $password;

    /**
     * @Assert\Valid
     * @OneToOne(targetEntity="AddressUser", cascade={"persist"})
     * @ORM\JoinColumn(name="address_user_id", referencedColumnName="address_user_id")
     */
    protected $address_user_id;

    /**
     * @Assert\Valid
     * @OneToOne(targetEntity="ContactUser", cascade={"persist"})
     * @JoinColumn(name="contact_user_id", referencedColumnName="contact_user_id")
     */
    protected $contact_user_id;

    /**
     * @Assert\Valid
     * @OneToOne(targetEntity="FinanceAccountUser", cascade={"persist"})
     * @ORM\JoinColumn(name="finance_account_user_id", referencedColumnName="finance_account_user_id")
     */
    protected $finance_account_user_id;

    /**
     * @ORM\Column(name="protect_code", type="string")
     * @Assert\NotNull(message="Kod ochrony nie może być pusty")
     * @Assert\NotBlank(message="Kod ochrony nie może być pusty")
     */
    protected $protect_code;

    /**
     * @ORM\Column(name="join_data", type="datetime")
     * @Assert\Date()
     */
    protected $join_data;

    public function __construct()
    {
        $this->join_data =  new \DateTime();
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set addressUserId
     *
     * @param string $addressUserId
     *
     * @return User
     */
    public function setAddressUserId($addressUserId)
    {
        $this->address_user_id = $addressUserId;

        return $this;
    }

    /**
     * Get addressUserId
     *
     * @return string
     */
    public function getAddressUserId()
    {
        if(empty($this->address_user_id)){
            $this->address_user_id = new AddressUser();
        }

        return $this->address_user_id;
    }

    /**
     * Set contactUserId
     *
     * @param integer $contactUserId
     *
     * @return User
     */
    public function setContactUserId($contactUserId)
    {
        $this->contact_user_id = $contactUserId;

        return $this;
    }

    /**
     * Get contactUserId
     *
     * @return integer
     */
    public function getContactUserId()
    {
        if(empty($this->contact_user_id)){
            $this->contact_user_id = new ContactUser();
        }

        return $this->contact_user_id;
    }

    /**
     * Set financeAccountUserId
     *
     * @param integer $financeAccountUserId
     *
     * @return User
     */
    public function setFinanceAccountUserId($financeAccountUserId)
    {
        $this->finance_account_user_id = $financeAccountUserId;

        return $this;
    }

    /**
     * Get financeAccountUserId
     *
     * @return integer
     */
    public function getFinanceAccountUserId()
    {
        if(empty($this->finance_account_user_id)){
            $this->finance_account_user_id = new FinanceAccountUser();
        }

        return $this->finance_account_user_id;
    }

    /**
     * Set protectCode
     *
     * @param integer $protectCode
     *
     * @return User
     */
    public function setProtectCode($protectCode)
    {
        $this->protect_code = $protectCode;

        return $this;
    }

    /**
     * Get protectCode
     *
     * @return integer
     */
    public function getProtectCode()
    {
        return $this->protect_code;
    }

    /**
     * Set joinData
     *
     * @param \DateTime $joinData
     *
     * @return User
     */
    public function setJoinData($joinData)
    {
        $this->join_data = $joinData;

        return $this;
    }

    /**
     * Get joinData
     *
     * @return \DateTime
     */
    public function getJoinData()
    {
        return $this->join_data;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->user_id,
            $this->email,
            $this->password,
        ]);
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->user_id,
            $this->email,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        if(empty($this->email)){
            return '';
        }
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    public function generateFinanceAccount()
    {
        $this->finance_account_user_id = new FinanceAccountUser();
        $this->finance_account_user_id->setBankAccountNumber(mt_rand());
        $this->finance_account_user_id->setGrandtotal(0);
        $this->finance_account_user_id->setProtectCode($this->getProtectCode());
        $this->finance_account_user_id->setSubtotal(0);
    }
}
