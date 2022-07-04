<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public const TEAM_NAMES = ['Forrari', 'Red Bison', 'Morecedes', 'Alpint', 'Alf Rome', 'McLoren'];
    public function load(ObjectManager $manager): void
    {
        $championship = ChampionshipFixtures::CHAMPIONSHIP_1;
        for ($i = 0; $i < count(self::TEAM_NAMES); $i++) {
            $team = new Team();
            $team->setName(self::TEAM_NAMES[$i]);
            $team->setCreatedAt(new \DateTimeImmutable('now'));
            $team->setChampionship(
                $this->getReference($championship)
            );
            $this->addReference(self::TEAM_NAMES[$i], $team);
            $manager->persist($team);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LeagueFixtures::class,
            ChampionshipFixtures::class,
        ];
    }
}
