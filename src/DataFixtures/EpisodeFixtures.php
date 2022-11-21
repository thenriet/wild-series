<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            'Title' => 'The First Episode',
            'Number' => '1',
            'Synopsis' => 'This is the first episode',
            'Season' => '1'
        ],
        [
            'Title' => 'The Second Episode',
            'Number' => '2',
            'Synopsis' => 'This is the second episode',
            'Season' => '1'
        ],
        [
            'Title' => 'The Third Episode',
            'Number' => '3',
            'Synopsis' => 'This is the third episode',
            'Season' => '1'
        ],
        [
            'Title' => 'The Fourth Episode',
            'Number' => '4',
            'Synopsis' => 'This is the fourth episode',
            'Season' => '1'
        ],
        [
            'Title' => 'The Fifth Episode',
            'Number' => '5',
            'Synopsis' => 'This is the fifth episode',
            'Season' => '1'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::EPISODES as $index => $episodes) {
            $episode = new Episode();
            foreach ($episodes as $column => $value) {

                if ($column === 'Title') {
                    $episode->setTitle($value);
                }
                if ($column === 'Number') {
                    $episode->setNumber($value);
                }
                if ($column === 'Synopsis') {
                    $episode->setSynopsis($value);
                }
                if ($column === 'Season') {
                    $episode->setSeason($this->getReference('season_' . $value));
                }
                $manager->persist($episode);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
