<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TaskController extends AbstractController
{
    /**
     * Read all the data from database
     *
     * @param TaskRepository $repository
     * @return Response
     */
    #[Route('/task', name: 'tasks')]
    #[IsGranted('ROLE_USER')]
    public function index(TaskRepository $repository): Response
    {
        $tasks = $repository->findBy(['user' => $this->getUser()]);
            
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
    #[IsGranted('ROLE_USER')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        // If the form is valid and submitted, data will be added in database
        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $task->setUser($this->getUser());
            
            $manager->persist($task);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre tâche a été ajoutée avec succès !'
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
     * @param Task $task
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/task/{id}/edit', name: 'update_task', methods: ['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === task.getUser()")]
    public function edit(Task $task, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        // If the form is valid and submitted, data will be added in database
        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $manager->persist($task);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre tâche a été modifiée avec succès!'
            );

            return $this->redirectToRoute('tasks');
        };
        return $this->render('update_task/edit.html.twig', [
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
            'Votre tâche a bien été supprimée !'
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
