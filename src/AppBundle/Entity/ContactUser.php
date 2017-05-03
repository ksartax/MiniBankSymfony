<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 21:18
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactUserRepository")
 * @ORM\Entity
 * @ORM\Table(name="contact_user")
 */
class ContactUser
{

    /**
     * @ORM\Column(name="contact_user_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    private $contact_user_id;

    /**
     * @ORM\Column(name="telephone", type="integer", length=25)
     * @Assert\NotNull(message="Telefon nie może być pusty")
     * @Assert\NotBlank(message="Telefon nie może być pusty")
     */
    private $telephone;

    /**
     * Get contactUserId
     *
     * @return integer
     */
    public function getContactUserId()
    {
        return $this->contact_user_id;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return ContactUser
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
