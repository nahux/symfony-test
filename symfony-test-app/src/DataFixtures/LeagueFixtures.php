<?php

namespace App\DataFixtures;

use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LeagueFixtures extends Fixture
{
    public const LEAGUE_1 = 'League_1';
    public const LEAGUE_2 = 'League_2';
    public const LEAGUE_3 = 'League_3';

    public function load(ObjectManager $manager): void
    {
        $league = new League();
        $league->setName('League_1');
        $league->setDisabled(false);
        $league->setCreatedAt(new \DateTimeImmutable('now'));
        $manager->persist($league);
        $this->addReference(self::LEAGUE_1, $league);

        $league = new League();
        $league->setName('League_2');
        $league->setDisabled(false);
        $league->setCreatedAt(new \DateTimeImmutable('now'));
        $manager->persist($league);
        $this->addReference(self::LEAGUE_2, $league);

        $league = new League();
        $league->setName('League_2');
        $league->setDisabled(false);
        $league->setCreatedAt(new \DateTimeImmutable('now'));
        $manager->persist($league);
        $this->addReference(self::LEAGUE_3, $league);

        $manager->flush();
    }
}
