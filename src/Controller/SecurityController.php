<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher)
    {
        $user = new Utilisateur();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $passwordHasher->hashPassword($user, $user->getMdp());
            $user->setMdp($hashedPassword);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_login');
        }


        return $this->render('blog/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

}