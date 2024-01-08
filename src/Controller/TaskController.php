<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class TaskController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/tasks", name="app_task_list")
     */
    public function tasksList(ManagerRegistry $doctrine): Response
    {

        $tasks = $doctrine->getRepository(Task::class)->findBy(['isDone' => 0]);

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks,
            'controller_name' => 'TaskController',
        ]);
    }

    /**
     * @Route("/tasks/ending", name="app_task_list_ending")
     */
    public function listEndingAction(ManagerRegistry $doctrine): Response
    {
        $tasks = $doctrine->getRepository(Task::class)->findBy(['isDone' => 1]);

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks,
            'controller_name' => 'TaskController',
        ]);
    }


    /**
     * @Route("/tasks/create", name="app_task_create")
     */
    public function createAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Récupérer l'id du user connecté
            $userConnected = $this->getUser();
            $task->setUser($userConnected);

            $this->entityManager->persist($task);
            $this->entityManager->flush();

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('app_default');
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/tasks/edit/{slug}", name="app_task_edit")
     */
    public function editAction(Task $task, Request $request)
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

 
            $this->entityManager->flush();

            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('app_task_list');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }


    /**
     * @Route("/tasks/{id}/toggle", name="app_task_toggle")
     */
    public function toggleTaskAction(Task $task)
    {
        $task->toggle(!$task->IsisDone());
        $this->entityManager->flush();

        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

        return $this->redirectToRoute('app_task_list');
    }


    /**
     * @Route("/tasks/{id}/delete", name="app_task_delete")
     */
    /*
    public function deleteTaskAction(Task $task)
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('app_task_list');
    }
    */



    public function deleteTaskAction(Task $task)
    {
        // Suppression de taches possible si user connecté === user_id de la tache OU si user anonyme = tache et que user connecté == admin
        if ( $task->getUser() === $this->getUser() || ($task->getUser() === null && $this->isGranted('ROLE_ADMIN'))) {
            
            $this->entityManager->remove($task);
            $this->entityManager->flush();

            $this->addFlash('success', 'La tâche a bien été supprimée.');

            return $this->redirectToRoute('app_task_list');
        } else {
            $this->addFlash('success', 'Vous navez pas les droits pour supprimer cette tâche.');
            return $this->redirectToRoute('app_task_list');
        }
    }

}
