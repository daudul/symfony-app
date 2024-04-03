<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function getStudentData()
    {
//        $db = $this->getEntityManager();

//            ->createQueryBuilder();


//        $query = $db->addSelect(array('s', 'c'))
//            ->from('App\Entity\Student', 's')
//            ->innerJoin(Course::class, 'c', Join::WITH, 'c.id = s.courseId')
//            ->groupBy('c.name')
//            ->getDQL();
//            ->getQuery()->getResult();

//        dd($query);

//        $rsm = new ResultSetMapping();
//
//        $query = $db->createNativeQuery('SELECT student.*, course.*, COUNT(student.id) as total FROM `student` LEFT JOIN course on course.id = student.course_id GROUP BY course.name', $rsm);
////        $query->setParameter(1, 'romanb');
//
//        $users = $query->getResult();
//
//        dd($users);
        $sql = 'SELECT student.*, course.*, COUNT(student.id) as total FROM `student` LEFT JOIN course on course.id = student.course_id GROUP BY course.name';
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($sql);
        return $stmt->executeQuery()->fetchAllAssociative();



    }

    //    /**
    //     * @return Student[] Returns an array of Student objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Student
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
