<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Entity\Ingresso;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DetailsController extends AbstractController
{
    /**
     * @Route("/details/{id}", name="details")
     */
    
    public function index(Request $request, Evento $evento)
    {
        $id = $request->get('id');
        if ($id != null) {
            $evento = $this->getDoctrine()->getRepository(Evento::class)->find($id);
        }

        $dados = [];
        $ingresso = new Ingresso();
        $ingressos = $this->getDoctrine()->getRepository(Ingresso::class)->findByCodigo($id);
        dump($ingressos);

        $form = $this->createFormBuilder($dados)
            ->add('cardNumber', TextType::class)
            ->add('CVV', TextType::class)
            ->add('validate', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('cardNumber')->getData() == '4000 0000 0000 0010' &&
                $form->get('CVV')->getData() == '111' &&
                $form->get('validate')->getData() == '12/20') {

                if ($ingressos[0][1] == null) {
                    $ingresso->setCodigo(1);
                }
                else {
                $ingresso->setCodigo($ingressos[0][1]+1);
                }

                /** @var \App\Entity\Cliente $iduser */
                $iduser = $this->getUser();
                $ingresso->setIdCliente($iduser);
                $ingresso->setIdEvento($evento);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ingresso);
                $entityManager->flush();

                return $this->redirectToRoute('ingresso', ['idingresso' => $ingresso->getId()]);
            }
            else {
                throw $this->createNotFoundException('Sorry not existing');
            }
        }

        return $this->render('details/index.html.twig', [
            'evento' => $evento,
            'form' => $form->createView(),
            'ingressos' => $ingressos
        ]);
    }

    /**
     * @Route("/ingresso/{idingresso}", name="ingresso")
     */
    public function imprimirIngresso(Request $request, $idingresso) {

        $ingresso = $this->getDoctrine()->getRepository(Ingresso::class)->find($idingresso);

        return $this->render('ingresso/ingresso.html.twig', [
            'ingresso' => $ingresso
        ]);
    }
}
