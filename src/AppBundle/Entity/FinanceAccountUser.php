<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 30.04.2017
 * Time: 21:18
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FinanceAccountUserRepository")
 * @ORM\Entity
 * @ORM\Table(name="finance_account_user")
 */
class FinanceAccountUser
{

    /**
     * @ORM\Column(name="finance_account_user_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    protected $finance_account_user_id;

    /**
     * @ORM\Column(name="bank_account_number", type="string")
     * @Assert\NotNull(message="Nr konta bankowego nie może być pusty")
     * @Assert\NotBlank(message="Nr konta bankowego nie może być pusty")
     */
    protected $bank_account_number;

    /**
     * @ORM\Column(name="grandtotal", type="float", options={"default"=0})
     */
    protected $grandtotal;

    /**
     * @ORM\Column(name="protect_code", type="string")
     * @Assert\NotNull(message="Kod ochrony nie może być pusty")
     * @Assert\NotBlank(message="Kod ochrony nie może być pusty")
     */
    protected $protect_code;

    /**
     * @ORM\Column(name="subtotal", type="float", options={"default"=0})
     */
    protected $subtotal;

    /**
     * @ORM\OneToMany(targetEntity="ToBankAccountTransaction", mappedBy="finance_account_user_id", cascade={"persist"})
     */
    protected $to_bank_account_transaction;

    /**
     * @ORM\OneToMany(targetEntity="FromBankAccountTransaction", mappedBy="finance_account_user_id")
     */
    protected $from_bank_account_transaction;

    /**
     * @ORM\OneToMany(targetEntity="RemoveIntoAccount", mappedBy="finance_account_user_id", cascade={"persist"})
     */
    protected $remove_into_account;

    /**
     * @OneToMany(targetEntity="DepositIntoAccount", mappedBy="finance_account_user_id", cascade={"persist"} )
     */
    protected $deposit_into_account;

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
     * Set bankAccountNumber
     *
     * @param string $bankAccountNumber
     *
     * @return FinanceAccountUser
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->bank_account_number = $bankAccountNumber;

        return $this;
    }

    /**
     * Get bankAccountNumber
     *
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->bank_account_number;
    }

    /**
     * Set grandtotal
     *
     * @param float $grandtotal
     *
     * @return FinanceAccountUser
     */
    public function setGrandtotal($grandtotal)
    {
        $this->grandtotal = $grandtotal;

        return $this;
    }

    /**
     * Get grandtotal
     *
     * @return float
     */
    public function getGrandtotal()
    {
        return $this->grandtotal;
    }

    /**
     * Set protectCode
     *
     * @param string $protectCode
     *
     * @return FinanceAccountUser
     */
    public function setProtectCode($protectCode)
    {
        $this->protect_code = $protectCode;

        return $this;
    }

    /**
     * Get protectCode
     *
     * @return string
     */
    public function getProtectCode()
    {
        return $this->protect_code;
    }

    /**
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return FinanceAccountUser
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->to_bank_account_transaction = new \Doctrine\Common\Collections\ArrayCollection();
        $this->from_bank_account_transaction = new \Doctrine\Common\Collections\ArrayCollection();
        $this->remove_into_account = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deposit_into_account = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add toBankAccountTransaction
     *
     * @param \AppBundle\Entity\ToBankAccountTransaction $toBankAccountTransaction
     *
     * @return FinanceAccountUser
     */
    public function addToBankAccountTransaction(\AppBundle\Entity\ToBankAccountTransaction $toBankAccountTransaction)
    {
        $this->to_bank_account_transaction[] = $toBankAccountTransaction;

        return $this;
    }

    /**
     * Remove toBankAccountTransaction
     *
     * @param \AppBundle\Entity\ToBankAccountTransaction $toBankAccountTransaction
     */
    public function removeToBankAccountTransaction(\AppBundle\Entity\ToBankAccountTransaction $toBankAccountTransaction)
    {
        $this->to_bank_account_transaction->removeElement($toBankAccountTransaction);
    }

    /**
     * Get toBankAccountTransaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getToBankAccountTransaction()
    {
        return $this->to_bank_account_transaction;
    }

    /**
     * Add fromBankAccountTransaction
     *
     * @param \AppBundle\Entity\FromBankAccountTransaction $fromBankAccountTransaction
     *
     * @return FinanceAccountUser
     */
    public function addFromBankAccountTransaction(\AppBundle\Entity\FromBankAccountTransaction $fromBankAccountTransaction)
    {
        $this->from_bank_account_transaction[] = $fromBankAccountTransaction;

        return $this;
    }

    /**
     * Remove fromBankAccountTransaction
     *
     * @param \AppBundle\Entity\FromBankAccountTransaction $fromBankAccountTransaction
     */
    public function removeFromBankAccountTransaction(\AppBundle\Entity\FromBankAccountTransaction $fromBankAccountTransaction)
    {
        $this->from_bank_account_transaction->removeElement($fromBankAccountTransaction);
    }

    /**
     * Get fromBankAccountTransaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFromBankAccountTransaction()
    {
        return $this->from_bank_account_transaction;
    }

    /**
     * Add removeIntoAccount
     *
     * @param \AppBundle\Entity\RemoveIntoAccount $removeIntoAccount
     *
     * @return FinanceAccountUser
     */
    public function addRemoveIntoAccount(\AppBundle\Entity\RemoveIntoAccount $removeIntoAccount)
    {
        $removeIntoAccount->setFinanceAccountUserId($this);
        $this->subGrandTotal($removeIntoAccount->getPrice());
        $this->remove_into_account[] = $removeIntoAccount;

        return $this;
    }

    /**
     * Remove removeIntoAccount
     *
     * @param \AppBundle\Entity\RemoveIntoAccount $removeIntoAccount
     */
    public function removeRemoveIntoAccount(\AppBundle\Entity\RemoveIntoAccount $removeIntoAccount)
    {
        $this->remove_into_account->removeElement($removeIntoAccount);
    }

    /**
     * Get removeIntoAccount
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemoveIntoAccount()
    {
        return $this->remove_into_account;
    }

    /**
     * Add depositIntoAccount
     *
     * @param \AppBundle\Entity\DepositIntoAccount $depositIntoAccount
     *
     * @return FinanceAccountUser
     */
    public function addDepositIntoAccount(\AppBundle\Entity\DepositIntoAccount $depositIntoAccount)
    {
        $depositIntoAccount->setFinanceAccountUserId($this);
        $this->addGrandTotal($depositIntoAccount->getPrice());
        $this->deposit_into_account[] = $depositIntoAccount;

        return $this;
    }

    public function subGrandTotal($price)
    {
        $this->grandtotal -= $price;
    }

    public function addGrandTotal($price)
    {
        $this->grandtotal += $price;
    }

    /**
     * Remove depositIntoAccount
     *
     * @param \AppBundle\Entity\DepositIntoAccount $depositIntoAccount
     */
    public function removeDepositIntoAccount(\AppBundle\Entity\DepositIntoAccount $depositIntoAccount)
    {
        $this->deposit_into_account->removeElement($depositIntoAccount);
    }

    /**
     * Get depositIntoAccount
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepositIntoAccount()
    {
        return $this->deposit_into_account;
    }


}
