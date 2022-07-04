<?php

namespace App\DataFixtures;

use App\Entity\Driver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DriverFixtures extends Fixture implements DependentFixtureInterface
{
    public const DRIVER_NAMES = [
        'Chalk Leg', 'Carlos Sanz',
        'Max Speedstappen', 'Sergio Lopez',
        'Luis Ham', 'George Ross',
        'Fermin Alfonso', 'Esteban Con',
        'Battery Voltas', 'Guanzhou Cho',
        'Larry Ronnis', 'Dominic Ricardo',
    ];
    const NATIONS = ['Argentina', 'Brazil', 'United Kingdom', 'Germany', 'Netherlands'];
    public function load(ObjectManager $manager): void
    {
        $teamIndex = 0;
        for ($i = 0; $i < count(self::DRIVER_NAMES); $i++) {
            $driver = new Driver();
            $driver->setName(self::DRIVER_NAMES[$i]);
            if (!($i === 0 || $i / 2 === count(TeamFixtures::TEAM_NAMES)) && $i % 2 === 0) {
                $teamIndex++;
            }
            $driver->setTeam(
                $this->getReference(TeamFixtures::TEAM_NAMES[$teamIndex])
            );
            $driver->setNationality(self::NATIONS[rand(0, count(self::NATIONS)-1)]);
            $driver->setCreatedAt(new \DateTimeImmutable('now'));
            $this->addReference(self::DRIVER_NAMES[$i], $driver);
            $manager->persist($driver);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LeagueFixtures::class,
            ChampionshipFixtures::class,
            TeamFixtures::class,
        ];
    }
}
