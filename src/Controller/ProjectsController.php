<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     * @return Response
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $projects = $entityManager->getRepository(Project::class)->findAll();

        return $this->render('projects/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
