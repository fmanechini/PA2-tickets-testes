<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\CadastroClienteType;
use App\Security\LoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class CadastroClienteController extends AbstractController
{
    /**
     * @Route("/cadastro", name="cadastro_cliente")
     */
    public function cadastro_cliente (Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator) : Response
    {
        $realizado = false;
        $cliente = new Cliente();

        $form = $this->createForm(CadastroClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $cliente->setPassword(
                $passwordEncoder->encodePassword(
                    $cliente,
                    $form->get('senha')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cliente);
            $entityManager->flush();

            $realizado = true;

            return $guardHandler->authenticateUserAndHandleSuccess(
                $cliente,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('cadastro_cliente/index.html.twig', [
            'controller_name' => 'CadastroClienteController',        
            'form' => $form->createView(),
            'realizado' => $realizado,
        ]);
    }
}
