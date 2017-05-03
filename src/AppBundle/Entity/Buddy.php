<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 23:00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BuddyRepository")
 * @ORM\Entity
 * @ORM\Table(name="buddy")
 */
class Buddy
{

    /**
     * @ORM\Column(name="buddy_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    protected $buddy_id;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="enemy_user_id", referencedColumnName="user_id")
     */
    protected $enemy_user_id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user_id;


    /**
     * Set buddyId
     *
     * @param integer $buddyId
     *
     * @return Buddy
     */
    public function setBuddyId($buddyId)
    {
        $this->buddy_id = $buddyId;

        return $this;
    }

    /**
     * Get buddyId
     *
     * @return integer
     */
    public function getBuddyId()
    {
        return $this->buddy_id;
    }

    /**
     * Set enemyUserId
     *
     * @param integer $enemyUserId
     *
     * @return Buddy
     */
    public function setEnemyUserId($enemyUserId)
    {
        $this->enemy_user_id = $enemyUserId;

        return $this;
    }

    /**
     * Get enemyUserId
     *
     * @return integer
     */
    public function getEnemyUserId()
    {
        return $this->enemy_user_id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Buddy
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
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
}
