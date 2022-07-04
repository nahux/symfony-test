<?php

namespace App\DataFixtures;

use App\Entity\Championship;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChampionshipFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHAMPIONSHIP_1 = 'Championship_1';

    public function load(ObjectManager $manager): void
    {
        $league = LeagueFixtures::LEAGUE_1;
        for ($i = 0; $i < 2; $i++) {
            $championship = new Championship();
            $championship->setName('Championship_' . $i + 1);
            $championship->setCreatedAt(new \DateTimeImmutable('now'));
            $championship->setLeague(
                $this->getReference($league)
            );
            $this->setReference(self::CHAMPIONSHIP_1, $championship);
            $manager->persist($championship);
        }

        $league = LeagueFixtures::LEAGUE_2;
        for ($i = 0; $i < 2; $i++) {
            $championship = new Championship();
            $championship->setName('Championship_' . $i + 1);
            $championship->setCreatedAt(new \DateTimeImmutable('now'));
            $championship->setLeague(
                $this->getReference($league)
            );
            $manager->persist($championship);
        }

        $league = LeagueFixtures::LEAGUE_3;
        for ($i = 0; $i < 2; $i++) {
            $championship = new Championship();
            $championship->setName('Championship_' . $i + 1);
            $championship->setCreatedAt(new \DateTimeImmutable('now'));
            $championship->setLeague(
                $this->getReference($league)
            );
            $manager->persist($championship);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LeagueFixtures::class,
        ];
    }
}
