<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\CadastroEventoType;
use App\Form\LocalEventoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CadastroEventoController extends AbstractController
{
    /**
     * @Route("/cadastroevento", name="cadastro_evento")
     */
    public function cadastro_evento (Request $request) : Response
    {
        $realizado = false;
        $evento = new Evento();

        $form = $this->createForm(CadastroEventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evento = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evento);
            $entityManager->flush();

            $realizado = true;
        }

        return $this->render('cadastro_evento/cadastroevento.html.twig', [
            'form' => $form->createView(),
            'realizado' => $realizado,
        ]);
    }
}
