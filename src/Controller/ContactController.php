<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\LanguageNames;
use App\Entity\User;
use App\Entity\SRS;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, Security $security): Response
    {
        $user = $security->getUser();

        $result = $request->query->has("result") ? $request->query->get("result") : "";

        if ($user != null) {
            $setSRS = $user->getSRS();
            if ($setSRS->isEmpty()) {
                return $this->render('contact/index.html.twig', [
                    'controller_name' => 'AddSRSController',
                    'user' => $user,
                    'noSRS' => true,
                    'userEmail' => $user->getEmail(),
                    'result' => $result
                ]);
            }

            $session = $request->getSession();
            $session->start();
            $srsId = $session->get('currentSRS');
    
            $repository = $this->getDoctrine()->getRepository(SRS::class);
            $srs = $repository->find($srsId);
    
            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
            $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
            
            return $this->render('contact/index.html.twig', [
                'controller_name' => 'AddSRSController',
                'user' => $user,
                'idiomaObjetivo' => $idiomaObjetivo,
                'idiomaNativo' => $idiomaNativo,
                'userEmail' => $user->getEmail(),
                'result' => $result
            ]);
        }
        
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'AddSRSController',
            'user' => null,
            'userEmail' => "",
            'result' => $result
        ]);
    }

    #[Route('/contacting', name: 'app_contacting')]
    public function contacting(Request $request, Security $security, MailerInterface $mailer): Response
    {
        if (!$request->request->has("email") || !$request->request->has("content")) {
            return $this->redirectToRoute('app_contact?result=failure');
        }
        $email = (new Email())
            ->to("srs.language.application@gmail.com")
            ->from($request->request->get("email"))
            ->subject("Contact email from SRS Application")
            ->text("Contenido de formulario de contacto:\n\n" . $request->request->get("content"));
        $mailer->send($email);
        
        return $this->redirect('/contact?result=success');
    }
}
