<?php

namespace App\DataFixtures;

use App\Entity\TicketStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class StatusFixtures extends Fixture implements FixtureGroupInterface
{
    const DEFAULT_STATUS = [
        'to_do' => 'TO DO',
        'active' => 'ACTIVE',
        'stand_by' => 'STAND BY',
        'closed' => 'CLOSED'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::DEFAULT_STATUS as $key => $status) {
            $newStatus = new TicketStatus();
            $newStatus->setName($key)
            ->setLabel($status);
            $manager->persist($newStatus);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['status'];
    }
}
