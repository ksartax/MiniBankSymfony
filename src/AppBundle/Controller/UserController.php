<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 01.05.2017
 * Time: 12:05
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Buddy;
use AppBundle\Entity\DepositIntoAccount;
use AppBundle\Entity\FromBankAccountTransaction;
use AppBundle\Entity\RemoveIntoAccount;
use AppBundle\Entity\ToBankAccountTransaction;
use AppBundle\Entity\User;
use AppBundle\Form\Address;
use AppBundle\Form\Contact;
use AppBundle\Form\Deposit;
use AppBundle\Form\Remove;
use AppBundle\Form\UserProfil;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @property User $user
 */
class UserController extends Controller
{

    /**
     * @Route("/user", name="user")
     */
    public function indexAction()
    {

        return $this->render('user/index.html.twig', [
            'user_firstname' => $this->getUser()->getFirstname() . " " . $this->getUser()->getLastname(),
            'user_finance_account_nr' => $this->getUser()->getFinanceAccountUserId()->getBankAccountNumber(),
            'account_money' => $this->getUser()->getFinanceAccountUserId()->getGrandtotal()
        ]);
    }

    /**
     * @Route("/user/profile", name="user_profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileAction(Request $request)
    {
        $user = $this->getUser();

        $formAddress = $this->createForm(Address::class, $user->getAddressUserId());
        $formContact = $this->createForm(Contact::class, $user->getContactUserId());
        $formUser = $this->createForm(UserProfil::class, $user);

        $formAddress->handleRequest($request);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $user->setAddressUserId(null);
        }

        if (
            ($formAddress->isSubmitted() && $formAddress->isValid())
            || ($formContact->isSubmitted() && $formContact->isValid())
        ) {
            $entity = $this
                ->getDoctrine()
                ->getManager();
            $entity->persist($user);
            $entity->flush();
        }

        return $this->render('user/profile.html.twig', [
            'formAddress' => $formAddress->createView(),
            'formContact' => $formContact->createView(),
            'formUser' => $formUser->createView(),
            'user_firstname' => $this->getUser()->getFirstname() . " " . $this->getUser()->getLastname(),
            'user_finance_account_nr' => $this->getUser()->getFinanceAccountUserId()->getBankAccountNumber(),
            'account_money' => $this->getUser()->getFinanceAccountUserId()->getGrandtotal()
        ]);
    }

    /**
     * @Route("/user/deposit", name="user_deposit")
     */
    public function depositAction(Request $request)
    {
        $deposit = new DepositIntoAccount();

        $form = $this->createForm(Deposit::class, $deposit);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $user = $this->getUser()->getFinanceAccountUserId()->addDepositIntoAccount($deposit);
            $entity = $this
                ->getDoctrine()
                ->getManager();
            $entity->persist($user);
            $entity->flush();
        }


        return $this->render('user/wplata.html.twig', [
            'user_deposit' => $this->getUser()->getFinanceAccountUserId()->getDepositIntoAccount(),
            'form' => $form->createView(),
            'user_firstname' => $this->getUser()->getFirstname() . " " . $this->getUser()->getLastname(),
            'user_finance_account_nr' => $this->getUser()->getFinanceAccountUserId()->getBankAccountNumber(),
            'account_money' => $this->getUser()->getFinanceAccountUserId()->getGrandtotal()
        ]);
    }

    public function findLatest($page = 1, array $data = [])
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');
        $query = $repository->createQueryBuilder('p');
        foreach ($data as $key => $item) {
            $query->where("p.{$key} = :{$key}")->setParameter("{$key}", $item);
        }

        return $this->createPaginator($query->getQuery(), $page);
    }

    /**
     * @Route("/user/remove", name="user_remove")
     */
    public function removeAction(Request $request)
    {
        $remove = new RemoveIntoAccount();

        $form = $this->createForm(Remove::class, $remove);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $user = $this->getUser()->getFinanceAccountUserId()->addRemoveIntoAccount($remove);
            $entity = $this
                ->getDoctrine()
                ->getManager();
            $entity->persist($user);
            $entity->flush();
        }

        return $this->render('user/wyplata.html.twig', [
            'form' => $form->createView(),
            'user_remove' => $this->getUser()->getFinanceAccountUserId()->getRemoveIntoAccount(),
            'user_firstname' => $this->getUser()->getFirstname() . " " . $this->getUser()->getLastname(),
            'user_finance_account_nr' => $this->getUser()->getFinanceAccountUserId()->getBankAccountNumber(),
            'account_money' => $this->getUser()->getFinanceAccountUserId()->getGrandtotal()
        ]);
    }

    /**
     * @Route("/user/transaction/{page}", name="user_transaction")
     */
    public function transactionAction($page = 1, Request $request)
    {

        if ($request->getMethod() == "POST") {
            $data = $request->request->all();
            $enemy = $this
                ->getDoctrine()
                ->getRepository('AppBundle:FinanceAccountUser')
                ->findOneBy(
                    [
                        'bank_account_number' => $data['account_nr']
                    ]
                );

            $from_finance = new FromBankAccountTransaction();
            $from_finance->setPrice($data['price']);
            $from_finance->setFinanceAccountUserId($enemy);
            $from_finance->setToFinanceAccountUserId($this->getUser()->getFinanceAccountUserId());
            $enemy->addGrandTotal($data['price']);

            $to_finance = new ToBankAccountTransaction();
            $to_finance->setPrice($data['price']);
            $to_finance->setFinanceAccountUserId($this->getUser()->getFinanceAccountUserId());
            $to_finance->setToFinanceAccountUserId($enemy);
            $this->getUser()->getFinanceAccountUserId()->subGrandTotal($data['price']);

            $entity = $this->getDoctrine()->getManager();
            $entity->persist($to_finance);
            $entity->persist($from_finance);
            $entity->persist($enemy);
            $entity->persist($this->getUser()->getFinanceAccountUserId());
            $entity->flush();
        }


        return $this->render('user/transfer.html.twig', [
            'user_from' => $this->getUser()->getFinanceAccountUserId()->getFromBankAccountTransaction(),
            'user_to' => $this->getUser()->getFinanceAccountUserId()->getToBankAccountTransaction(),
            'users' => $this->findLatest($page, $this->filterUser($request)),
            'buddy' => $this->getDoctrine()->getRepository('AppBundle:Buddy')->findBy(['user_id' => $this->getUser()->getUserId()] + $this->filterBuddy($request)),
            'user_firstname' => $this->getUser()->getFirstname() . " " . $this->getUser()->getLastname(),
            'user_finance_account_nr' => $this->getUser()->getFinanceAccountUserId()->getBankAccountNumber(),
            'account_money' => $this->getUser()->getFinanceAccountUserId()->getGrandtotal()
        ]);
    }

    private function filterUser($request)
    {
        $data = [];
        if (!empty($request->query->get('email'))) {
            $data['email'] = $request->query->get('email');
        }
        if (!empty($request->query->get('lastname'))) {
            $data['lastname'] = $request->query->get('lastname');
        }
        if (!empty($request->query->get('bank_account_number'))) {
            $pom = $this
                ->getDoctrine()
                ->getRepository('AppBundle:FinanceAccountUser')
                ->findOneBy(
                    [
                        'bank_account_number' => $request->query->get('bank_account_number')
                    ]
                );
            if (empty($pom)) {
                $data['finance_account_user_id'] = null;
            } else {
                $data['finance_account_user_id'] = $pom->getFinanceAccountUserId();
            }
        }

        return $data;
    }

    private function filterBuddy($request)
    {
        $data = [];
        if (!empty($request->query->get('lastname_buddy'))) {
            $data['enemy_user_id'] = $this
                ->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findBy(
                    [
                        'lastname' => $request->query->get('lastname_buddy')
                    ]
                );
        }
        if (!empty($request->query->get('lastname_buddy')) && empty($data['enemy_user_id'])) {
            $pom = $this
                ->getDoctrine()
                ->getRepository('AppBundle:FinanceAccountUser')
                ->findOneBy(
                    [
                        'bank_account_number' => $request->query->get('lastname_buddy')
                    ]
                );
            if (empty($pom)) {
                $data['enemy_user_id'] = null;
            } else {
                $data['enemy_user_id'] = $this
                    ->getDoctrine()
                    ->getRepository('AppBundle:User')
                    ->findOneBy(
                        [
                            'finance_account_user_id' => $pom->getFinanceAccountUserId()
                        ]
                    );
            }
        }

        return $data;
    }

    /**
     * @Route("/user/setBudy", name="user_setBudy")
     * @Method("POST")
     */
    public function setBuddy(Request $request)
    {
        $email = $request->request->get('email');
        if (empty($email)) {
            throw new InvalidArgumentException();
        }

        $buddy = new Buddy();
        $buddy->setEnemyUserId($this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(['email' => $email]));
        $buddy->setUserId($this->getUser());

        $entity = $this->getDoctrine()->getManager();
        $entity->persist($buddy);
        $entity->flush();

        $response = new Response(json_encode(
            [
                'firstname_lastname' => $buddy->getEnemyUserId()->getFirstname() . " " . $buddy->getEnemyUserId()->getLastname(),
                'account_nr' => $buddy->getEnemyUserId()->getFinanceAccountUserId()->getBankAccountNumber()
            ]
        ));

        return $response;
    }

    private function createPaginator(Query $query, $page)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(5);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}