<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'contacts')]
    public function listeContacts(EntityManagerInterface $entityManager): Response
    {
        $repo = $entityManager->getRepository(Contact::class);
        $contacts = $repo->findAll();

        return $this->render('contact/listeContacts.html.twig', [
            'lesContacts' => $contacts
        ]);
    }
}

