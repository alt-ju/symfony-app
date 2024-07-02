<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'tasks')]
    public function index(TaskRepository $repository): Response
    {
        $tasks = $repository->findAll();
            
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks
        ]);
    }
}
