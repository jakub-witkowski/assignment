<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddUserController extends AbstractController
{
    #[Route('/add-user', name: 'app_add_user')]
    public function index(UserRepository $repository, Request $request, EntityManagerInterface $em): Response
    {
        // utworzenie formularza
        $form = $this->createForm(UserFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // pobranie danych z formularza
            $firstName = $form->get('firstName')->getData();
            $lastName = $form->get('lastName')->getData();

            // utworzenie nowego pracownika w oparciu o dane pobrane z formularza
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);

            // zachowanie pracownika w bazie danych
            $em->persist($user);
            $em->flush();

            $json = [
                'response' => [
                    'id' => $user->getId(),
                ]
            ];

            return new JsonResponse($json);
        }

        return $this->render('add_user/index.html.twig', [
            'controller_name' => 'AddUserController',
            'userForm' => $form->createView(),
        ]);
    }
}
