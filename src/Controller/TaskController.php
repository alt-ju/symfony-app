<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TaskType;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class TaskController extends AbstractController
{
    /**
     * Read all the data from database
     *
     * @param TaskRepository $repository
     * @return Response
     */
    #[Route('/task', name: 'tasks')]
    public function index(TaskRepository $repository): Response
    {
        $tasks = $repository->findAll();
            
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show a form to create a new task
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/task/new', name: 'new_task', methods : ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $manager->persist($task);
            $manager->flush();

            $this->addFlash(
                'success',
                'Your task was added successfully!'
            );

            return $this->redirectToRoute('tasks');
        };

        return $this->render('new_task/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Show a form to update a task identified by its id 
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/task/{id}/edit', name: 'update_task', methods: ['GET', 'POST'])]
    public function edit(Task $task, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $manager->persist($task);
            $manager->flush();

            $this->addFlash(
                'success',
                'Your task was updated successfully!'
            );

            return $this->redirectToRoute('tasks');
        };
        return $this->render('update_task/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete a task 
     * 
     * @param Task $task
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/task/{id}/delete', name: 'delete_task', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Task $task) : Response
    {
        $manager->remove($task);
        $manager->flush();

        $this->addFlash(
            'success',
            'Your task was deleted successfully !'
        );

        return $this->redirectToRoute('tasks');
    }
    
    /**
     * Function to read the data of one specific task
     * 
     * @param Task $task
     * @param Request $request
     * @return Response
     */
    #[Route('/task/{id}', name: 'read_task', methods: ['GET'])]
    public function read(Task $task, Request $request) : Response
    {   
        return $this->render('read_task/read.html.twig', [
            'task' => $task,
        ]);
    }
}
