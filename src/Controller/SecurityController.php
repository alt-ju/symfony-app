<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{   
    /**
     * Connexion function 
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    #[Route('/connexion', name: 'security_login', methods: ["GET", "POST"])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error, 
        ]);
        
        $this->redirectToRoute('tasks');
    }

    /**
     * Logout function where route is specified, everything is handled automatically and in security.yaml
     *
     * @param Security $security
     * @return Response
     */
    #[Route('/deconnexion', name: 'security_logout')]
    public function logout(Security $security): Response 
    {
       
    }

    /**
     * Registration function 
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    #[Route('/inscription', name: 'security_registration', methods: ["GET", "POST"])]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new Users();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        // If the form is valid and submitted, data will be added in database
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainpassword = $form->get('plainpassword')->getData();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainpassword
            );
            $user->setPassword($hashedPassword);

            $this->addFlash(
                'success',
                'Votre compte a bien été créé'
            );

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
