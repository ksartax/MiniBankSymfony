<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 23:05
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepositIntoAccountRepository")
 * @ORM\Entity
 * @ORM\Table(name="deposit_into_account")
 */
class DepositIntoAccount
{

    /**
     * @ORM\Column(
     *     name="deposit_into_account_id",
     *     type="integer"
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $deposit_into_account_id;

    /**
     * @ORM\Column(
     *     name="price",
     *     type="float",
     *     options={"default"=0}
     *     )
     */
    protected $price;

    /**
     * @ManyToOne(targetEntity="FinanceAccountUser", inversedBy="deposit_into_account")
     * @JoinColumn(name="finance_account_user_id", referencedColumnName="finance_account_user_id")
     */
    protected $finance_account_user_id;

    /**
     * @ORM\Column(name="join_data", type="datetime")
     * @Assert\Date()
     */
    protected $createData;

    public function __construct()
    {
        $this->createData = new \DateTime();
    }


    /**
     * Get depositIntoAccountId
     *
     * @return integer
     */
    public function getDepositIntoAccountId()
    {
        return $this->deposit_into_account_id;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return DepositIntoAccount
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
     * @return DepositIntoAccount
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
     * @return DepositIntoAccount
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
