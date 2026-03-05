<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    const ITEM_COUNT = 5;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

         $user = new User();
            $user->setUsername('admin')
            ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->passwordHasher->hashPassword($user, 'password'));

        $manager->persist($user);

        for ($i = 0; $i <= self::ITEM_COUNT; $i++) {
            $user = new User();
            $user->setUsername($faker->userName())
            ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->passwordHasher->hashPassword($user, 'password'));

            $manager->persist($user);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
