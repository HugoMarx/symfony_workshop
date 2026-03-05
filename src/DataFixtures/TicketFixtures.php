<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use App\Repository\TicketPriorityRepository;
use App\Repository\TicketStatusRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TicketFixtures extends Fixture implements DependentFixtureInterface
{
    const ITEM_COUNT = 10;

    public function __construct(
        private UserRepository $userRepo,
        private TicketStatusRepository $ticketStatusRepo,
        private TicketPriorityRepository $ticketPriorityRepo
        ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i <= self::ITEM_COUNT; $i++) {
            $ticket = new Ticket();
            $dateTime = $faker->dateTimeThisYear('-2 weeks');
            $ticket->setTitle($faker->words(3, true))
                ->setStatus($this->ticketStatusRepo->findOneBy(['name' => 'to_do']))
                ->setPriority($this->ticketPriorityRepo->findOneBy(['name' => 'low']))
                ->setDescription($faker->sentence(2))
                ->setCreated($dateTime)
                ->setModified($dateTime)
                ->setAuthor($this->userRepo->find(1));
            $manager->persist($ticket);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            StatusFixtures::class,
            PriorityFixtures::class
        ];
    }
}
