<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $student = new Student();
        $student->setName('Daudul Islam');
        $student->setRoll(3012);
        $student->setJoinDate(new \DateTime('2024-04-01'));
        $student->AddCourseId($this->getReference('course'));
        $manager->persist($student);

        $student1 = new Student();
        $student1->setName('Abdus Samad');
        $student1->setRoll(2014);
        $student1->setJoinDate(new \DateTime('2023-03-11'));
        $student1->AddCourseId($this->getReference('course'));
        $manager->persist($student1);

        $student2 = new Student();
        $student2->setName('Raju');
        $student2->setRoll(2015);
        $student2->setJoinDate(new \DateTime('2024-01-01'));
        $student2->AddCourseId($this->getReference('course1'));
        $manager->persist($student2);

        $student3 = new Student();
        $student3->setName('Hasan');
        $student3->setRoll(2025);
        $student3->setJoinDate(new \DateTime('2024-04-01'));
        $student3->AddCourseId($this->getReference('course2'));
        $manager->persist($student3);



        $manager->flush();
    }
}
