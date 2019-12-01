<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CadastroClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_cliente', TextType::class, ['label' => 'Usuário'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('cpf', TextType::class, ['label' => 'CPF'])
            ->add('telefone', TextType::class, ['label' => 'Telefone'])
            ->add('senha', PasswordType::class, ['label' => 'Senha'])
            ->add('confirma', SubmitType::class, ['label' => 'Cadastrar'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
