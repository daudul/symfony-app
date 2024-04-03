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
        $movie->setTitle('The Dark Night');
        $movie->setReleaseYear(2018);
        $movie->setDescription('Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries');
        $movie->setImagePath('https://fastly.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI');

        $movie->addActor($this->getReference('actor'));
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Second Movie');
        $movie2->setReleaseYear(2019);
        $movie2->setDescription('Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');
        $movie2->setImagePath('https://fastly.picsum.photos/id/682/200/300.jpg?hmac=z-Zlq9KVG3pNsE5Jo6A7vqnh-B910bdMztU5AZKQV-o');

        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));

        $manager->persist($movie2);

        $manager->flush();
    }
}
