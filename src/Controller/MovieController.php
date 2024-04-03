<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/movie', name: 'app_movie')]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
//        $movies = $movieRepository->find(5);
//        dd($movies);
        return $this->render('movie/index.html.twig', ['movies' => $movies]);
    }

    #[Route('/movie/create', name: 'create_movie')]
    public function create(Request $request):Response
    {

        try {
            $movie = new Movie();
            $form = $this->createForm(MovieFormType::class, $movie);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $newMovie = $form->getData();
                $imagePath = $form->get('imagePath')->getData();


                if ($imagePath) {
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );

                    $newMovie->setImagePath('/uploads/' . $newFileName);
                }

                $this->em->persist($newMovie);
                $this->em->flush();

                $this->addFlash(
                    'success',
                    'Movie added successfully'
                );

                return $this->redirectToRoute('create_movie');
            }



            return $this->render('movie/create.html.twig', [
                'form' => $form->createView()
            ]);
        }catch (\Exception $e) {
            $this->addFlash(
                'danger',
                'Movie added successfully'
            );

            return $this->redirectToRoute('create_movie');
        }
    }


}
