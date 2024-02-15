<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
;

class UserAdminFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;

    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("admin@admin.fr");
        $user->setPassword($this->hasher->hashPassword($user, "admin"));
        $user->setNom("ADMIN");
        $user->setPrenom("Admin");
        $user->setRoles([ "ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();
    }
}
