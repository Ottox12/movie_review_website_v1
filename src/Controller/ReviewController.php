<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReviewFormType;
use App\Entity\Review;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="review")
     */

        public function submitReview(Request $request): Response
    {
        $review = new Review(); // Create a new instance of the Review entity
        $form = $this->createForm(ReviewFormType::class, $review);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            $this->addFlash('success', 'Thank you for your review!');

            return $this->redirectToRoute('review');
        }

        return $this->render('review/review.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    }
