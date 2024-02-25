<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;




class MovieApiController extends AbstractController
{
    #[Route('/movies/api', name: 'api_movies')]
    public function listMovie(ManagerRegistry $doctrine): Response
    {
        $movies = $doctrine->getRepository(Movie::class)->findAll();


        return $this->json($movies);
    }

    /**
     * @Route("movies/api/{id}", methods={"GET"})
     */

    public function readMovie($id, ManagerRegistry $doctrine): Response
    {
        $movies = $doctrine->getRepository(Movie::class)->find($id);


        if (!$movies) {
            throw $this->createNotFoundException();
        }

        return $this->json($movies);
    }

    /**
     * @Route("/api/movies", methods={"POST"})
     */
    public function createMovie(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();
        }
            return $this->json($movie, Response::HTTP_CREATED);
            }

    /**
     * @Route("/api/movies/{id}", name="update_movie", methods={"PUT"})
     */
    public function updateMovie(Request $request, Movie $movie): Response
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($movie, Response::HTTP_OK);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }
    /**
     * @Route("/api/movies/{id}", methods={"DELETE"})
     */
    public function deleteMovie(Movie $movie): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->json(['message' => 'Movie deleted successfully'], Response::HTTP_OK);
    }


        }
