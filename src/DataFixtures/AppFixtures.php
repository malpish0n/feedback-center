<?php

namespace App\DataFixtures;

use App\Entity\HomePageContent;
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

        $homePageContent = new HomePageContent();
        $homePageContent->setTitle('Tytuł');
        $homePageContent->setContent('Treść');

        $manager->persist($homePageContent);
        $manager->persist($feedback);
        $manager->flush();

    }
}
