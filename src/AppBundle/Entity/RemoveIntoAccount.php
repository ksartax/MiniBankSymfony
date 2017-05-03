<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 23:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RemoveIntoAccountRepository")
 * @ORM\Entity
 * @ORM\Table(name="remove_into_account")
 */
class RemoveIntoAccount
{

    /**
     * @ORM\Column(
     *     name="remove_into_account_id",
     *     type="integer"
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $remove_into_account_id;

    /**
     * @ORM\Column(
     *     name="price",
     *     type="float",
     *     options={"default"=0}
     *     )
     */
    private $price;

    /**
     * @ManyToOne(targetEntity="FinanceAccountUser", inversedBy="remove_into_account")
     * @JoinColumn(name="finance_account_user_id", referencedColumnName="finance_account_user_id")
     */
    private $finance_account_user_id;

    /**
     * @ORM\Column(name="join_data", type="datetime")
     * @Assert\Date()
     */
    private $createData;

    public function __construct()
    {
        $this->createData = new \DateTime();
    }


    /**
     * Get removeIntoAccountId
     *
     * @return integer
     */
    public function getRemoveIntoAccountId()
    {
        return $this->remove_into_account_id;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return RemoveIntoAccount
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set financeAccountUserId
     *
     * @param integer $financeAccountUserId
     *
     * @return RemoveIntoAccount
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
        return $this->finance_account_user_id;
    }

    /**
     * Set createData
     *
     * @param \DateTime $createData
     *
     * @return RemoveIntoAccount
     */
    public function setCreateData($createData)
    {
        $this->createData = $createData;

        return $this;
    }

    /**
     * Get createData
     *
     * @return \DateTime
     */
    public function getCreateData()
    {
        return $this->createData;
    }
}
