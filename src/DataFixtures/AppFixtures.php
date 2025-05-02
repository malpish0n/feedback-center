<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $feedback = new Feedback();
        $feedback->setTitle('Pomysł 1');
        $feedback->setContent('Opis');

        $manager->persist($feedback);
        $manager->flush();

    }
}
