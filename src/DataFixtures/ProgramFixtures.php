<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'Title' => 'American Horror Story',
            'Synopsis' => 'Various horror stories with good acting',
            'Category' => 'Horreur',
            'Program' => 'program_American-Horror-Story'
        ],
        [
            'Title' => 'The Office',
            'Synopsis' => 'Hilarious comedy',
            'Category' => 'Comédie',
            'Program' => 'program_The-Office'
        ],
        [
            'Title' => 'Game Of Thrones',
            'Synopsis' => 'Epic story in an heroic-fantasy world',
            'Category' => 'Aventure',
            'Program' => 'program_Game-Of-Thrones'
        ],
        [
            'Title' => 'The Walking Dead',
            'Synopsis' => 'Zombies invading the world',
            'Category' => 'Horreur',
            'Program' => 'program_The-Walking-Dead'
        ],
        [
            'Title' => 'Breaking Bad',
            'Synopsis' => 'A common chemistry teacher starts cooking meth',
            'Category' => 'Drame',
            'Program' => 'program_Breaking-Bad'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::PROGRAMS as $index => $programs) {
            $program = new Program();
            foreach ($programs as $column => $value) {

                if ($column === 'Title') {
                    $program->setTitle($value);
                }
                if ($column === 'Synopsis') {
                    $program->setSynopsis($value);
                }
                if ($column === 'Category') {
                    $program->setCategory($this->getReference('category_' . $value));
                }
                if ($column === 'Program') {
                    $this->addReference($value, $program);
                }
                $manager->persist($program);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
