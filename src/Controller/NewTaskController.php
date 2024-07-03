<?php

namespace App\Controller;

use App\Form\NewTaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewTaskController extends AbstractController
{
    #[Route('/new/task', name: 'app_new_task')]
    public function index(): Response
    {
        $form = $this->createForm(NewTaskType::class);
        return $this->render('new_task/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
