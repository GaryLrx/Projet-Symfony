<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {

        $data = new Contact();

        $form = $this->createForm(ContactType::class, $data);
        // traiter la requête lors du clic sur le bouton submit //
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager(); // Gérer la connexion à la BDD //
            $em->persist($data); // Ajoute à la requête les DATAS récupérées //
            $em->flush(); // executer la requête //

            return $this->redirectToRoute('contact');
        }

        $contact = $doctrine->getRepository(Contact::class)->findAll();

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'monFormulaire' => $contact,
            "createForm"=>$form->createView()
        ]);
    }

}
