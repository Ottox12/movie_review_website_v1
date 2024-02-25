<?php

namespace App\DataFixtures;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('Loving Pablo');
        $movie->setRunningTime (2,3);
        $movie->setDirector ('Fernando León de Aranoa');
        $movie->setDescription ('Virginia Vallejo, a renowned Colombian journalist and television presenter, has an affair with Pablo Escobar, the countrys most notorious drug dealer.');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2019/08/29/19/17/pablo-escobar-4439780_1280.png');
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));
        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle ('Chernobyl: Abyss');
        $movie2->setRunningTime (2,16);
        $movie2->setDirector ('Danila Kozlovskiy');
        $movie2->setDescription ('After reuniting with a lost love, firefighter Alexey retires to begin a new life -- but the Chernobyl disaster suddenly plunges him back into danger.');
        $movie2->setImagePath('https://cdn.pixabay.com/photo/2020/01/01/12/04/atom-4733476_1280.jpg');
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));
        $manager->persist($movie2);

        $manager->flush();
    }
}
