<?php

namespace App\DataFixtures;

use App\Entity\TicketPriority;
use App\Entity\TicketStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class PriorityFixtures extends Fixture implements FixtureGroupInterface
{
    const DEFAULT_PRIORITY = [
        'low' => 'LOW',
        'medium' => 'MEDIUM',
        'high' => 'HIGH',
        'urgent' => 'URGENT'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::DEFAULT_PRIORITY as $key => $status) {
            $newPriority = new TicketPriority();
            $newPriority->setName($key)
            ->setLabel($status);
            $manager->persist($newPriority);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['priority'];
    }
}
