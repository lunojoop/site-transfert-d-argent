<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        $role = new Role();
        $role->setLibelle("SUP_ADMIN");
        $manager->persist($role);
        $role1 = new Role();
        $role1->setLibelle("ADMIN");
        $manager->persist($role1);
        $role2 = new Role();
        $role2->setLibelle("CAISSIER");
        $manager->persist($role2);
        $role3 = new Role();
        $role3->setLibelle("PARTENAIRE");
        $manager->persist($role3);
        $manager->flush();

        $user = new User();
        $user->setNom("Diop");
        $user->setPrenom("Alioune Badara");
        $user->setLogin("sup_admin@amin.sn");
        $user->setusername("sup-admin");
        $user->setPassword($this->encoder->encodePassword($user, "admin"));
        
        $user->setIsAtive("1");
        $user->setRole($role);

        $manager->persist($user);
        //dd($user->getRoles());
        $manager->flush();
        
    
            
        

        $manager->flush();
    }
}
