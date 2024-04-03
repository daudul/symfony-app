<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Student;
use App\Form\EditFormType;
use App\Form\StudentFormType;
use App\Repository\CourseRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StudentController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/student', name: 'app_student')]
    public function index(StudentRepository $studentRepository): Response
    {
        //dd($studentRepository->getStudentData());
        $name = [];
        $total = [];
        foreach ($studentRepository->getStudentData() as $data) {
            $name[] = $data['name'];
            $total[] = $data['total'];
        }

        //dd(json_encode($name), json_encode($total));

        return $this->render('student/index.html.twig', [
            'name' => json_encode($name),
            'total' => json_encode($total),
        ]);
    }

    #[Route('student/create', name: 'create_student')]
    public function create(Request $request):Response
    {
        try {
            $student = new Student();
            $form = $this->createForm(StudentFormType::class, $student);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->persist($form->getData());
                $this->em->flush();

                $this->addFlash(
                    'success',
                    'Student added successfully'
                );

                return $this->redirectToRoute('create_student');
            }

            return $this->render('student/create.html.twig', [
                'form' => $form->createView()
            ]);
        }catch (\Exception $e){
            dd($e->getMessage(), $e->getLine());
        }
    }

    #[Route('student/edit/{id}')]
    public function edit(StudentRepository $studentRepository, Request $request, int $id, CourseRepository $courseRepository): Response
    {
        try {
            $student = $studentRepository->find($id);

            $form = $this->createForm(EditFormType::class, $student, ['select_option' => $courseRepository->find($student->getCourseId())]);
            $form->handleRequest($request);

            return $this->render('student/edit.html.twig',[
                'student' => $student,
                'form' => $form->createView()
            ]);
        }catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine());
        }
    }
}
