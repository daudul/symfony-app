<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $course = new Course();
        $course->setName('Computer Science');
        $manager->persist($course);

        $course1 = new Course();
        $course1->setName('Cyber Security');
        $manager->persist($course1);

        $course2 = new Course();
        $course2->setName('Machine Learning');
        $manager->persist($course2);

        $manager->flush();

        $this->addReference('course', $course);
        $this->addReference('course1', $course1);
        $this->addReference('course2', $course2);

    }
}
