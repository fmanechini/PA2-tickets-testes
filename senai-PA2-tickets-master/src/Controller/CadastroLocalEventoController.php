<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\LocalEvento;
use App\Form\LocalEventoType;

class CadastroLocalEventoController extends AbstractController
{
    /**
     * @Route("/cadastrolocal", name="cadastro_local")
     */
    public function cadastro_evento (Request $request) : Response
    {
        $realizado = false;
        $localevento = new LocalEvento();

        $form = $this->createForm(LocalEventoType::class, $localevento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $localevento = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($localevento);
            $entityManager->flush();

            $realizado = true;
        }

        return $this->render('cadastro_local_evento/cadastrolocal.html.twig', [
            'form' => $form->createView(),
            'realizado' => $realizado,
        ]);
    }
}
