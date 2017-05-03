<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 01.05.2017
 * Time: 13:02
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Register;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->redirect('login');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {

        $helper = $this->get('security.authentication_utils');

        return $this->render('security/login.html.twig', [
            // last username entered by the user (if any) ryanpass
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(Register::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->generateFinanceAccount();
            $user->setActive(1);
            $encoder = $this->container->get('security.password_encoder');
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $entity = $this->getDoctrine()->getManager();
            $entity->persist($user);
            $entity->flush();

            return $this->redirect('login');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }

}