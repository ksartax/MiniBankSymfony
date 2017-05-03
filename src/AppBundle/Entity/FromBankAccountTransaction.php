<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 23:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FromBankAccountTransactionRepository")
 * @ORM\Entity
 * @ORM\Table(name="from_bank_account_transaction")
 */
class FromBankAccountTransaction
{

    /**
     * @ORM\Column(
     *     name="from_bank_account_transaction_id",
     *     type="integer"
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $from_bank_account_transaction_id;

    /**
     * @ORM\Column(
     *     name="price",
     *     type="float",
     *     options={"default"=0}
     *     )
     */
    private $price;

    /**
     * @ManyToOne(targetEntity="FinanceAccountUser", inversedBy="from_bank_account_transaction")
     * @JoinColumn(name="finance_account_user_id", referencedColumnName="finance_account_user_id")
     */
    private $finance_account_user_id;

    /**
     * @ORM\Column(name="join_data", type="datetime")
     * @Assert\Date()
     */
    private $createData;

    /**
     * @ManyToOne(targetEntity="FinanceAccountUser", inversedBy="from_bank_account_transaction")
     * @JoinColumn(name="to_finance_account_user_id", referencedColumnName="finance_account_user_id")
     */
    private $to_finance_account_user_id;

    public function __construct()
    {
        $this->createData = new \DateTime();
    }


    /**
     * Get fromBankAccountTransactionId
     *
     * @return integer
     */
    public function getFromBankAccountTransactionId()
    {
        return $this->from_bank_account_transaction_id;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return FromBankAccountTransaction
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
     *
     * @param $financeAccountUserId
     * @return FromBankAccountTransaction
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
     * @return FromBankAccountTransaction
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

    /**
     * Set toFinanceAccountUserId
     *
     * @param $toFinanceAccountUserId
     * @return FromBankAccountTransaction
     */
    public function setToFinanceAccountUserId($toFinanceAccountUserId)
    {
        $this->to_finance_account_user_id = $toFinanceAccountUserId;

        return $this;
    }

    /**
     * Get toFinanceAccountUserId
     *
     * @return integer
     */
    public function getToFinanceAccountUserId()
    {
        return $this->to_finance_account_user_id;
    }
}
