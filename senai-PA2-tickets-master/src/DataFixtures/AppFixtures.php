<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Cliente;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new Cliente();
        $userAdmin->setNomeCliente('admin');
        $userAdmin->setEmail('admin@email.com');
        $userAdmin->setCpf('99988877766');
        $userAdmin->setTelefone('99988776655');
        $password = $this->encoder->encodePassword($userAdmin, 'test');
        $userAdmin->setPassword($password);    
        $userAdmin->setRoles(['ROLE_ADMIN']);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
