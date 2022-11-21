<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        [
            'Number' => '1',
            'Year' => '2000',
            'Description' => 'Saison 1',
            'Program' => 'The-Walking-Dead'
        ],
        [
            'Number' => '2',
            'Year' => '2001',
            'Description' => 'Saison 2',
            'Program' => 'The-Walking-Dead'
        ],
        [
            'Number' => '3',
            'Year' => '2002',
            'Description' => 'Saison 3',
            'Program' => 'The-Walking-Dead'
        ],
        [
            'Number' => '4',
            'Year' => '2003',
            'Description' => 'Saison 4',
            'Program' => 'The-Walking-Dead'
        ],
        [
            'Number' => '5',
            'Year' => '2004',
            'Description' => 'Saison 5',
            'Program' => 'The-Walking-Dead'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::SEASONS as $index => $seasons) {
            $season = new Season();
            foreach ($seasons as $column => $value) {

                if ($column === 'Number') {
                    $season->setNumber($value);
                    $this->addReference('season_' . $value, $season);
                }
                if ($column === 'Year') {
                    $season->setYear($value);
                }
                if ($column === 'Description') {
                    $season->setDescription($value);
                }
                if ($column === 'Program') {
                    $season->setProgram($this->getReference('program_' . $value));
                }
                $manager->persist($season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
