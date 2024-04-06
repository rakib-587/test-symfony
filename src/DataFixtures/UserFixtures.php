<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // System Admin
        $systemAdmin = new User();
        $systemAdmin->setEmail('admin@example.com');
        $systemAdmin->setPlainPassword('admin');
        $systemAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($systemAdmin);

        // Create general users
        for ($i = 1; $i <= 20; ++$i) {
            $user = new User();
            $user->setEmail('user' . $i . '@example.com');
            $user->setPlainPassword('aaaaaa');
            $manager->persist($user);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
