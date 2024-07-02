<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskNewController extends AbstractController
{
    #[Route('/task/new', name: 'task_new')]
    // public function index(): Response
    // {
    //     return $this->render('task_new/new.html.twig', [
    //         'controller_name' => 'TaskNewController',
    //     ]);
    // }

    public function new(Request $request): Response
    {
        $task = new Task();
        $task->setTitle('test');
        $task->setDescription('test');
        $task->setStatus('test');

        $f = $this->createForm(TaskType::class, $task);
        
        return $this->render('task_new/new.html.twig', [
            'form' => $f,
        ]);
    }
}
