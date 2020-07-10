<?php

namespace Controller\Front\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Model\Task;
use Model\Budget;
use Model\BudgetItem;
use Model\Couple;
use Model\Guest;
use Form\TaskType;
use Form\CoupleType;

class CoupleController extends AbstractController
{
    public function todo(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $task = new Task;
        $form = $this->createForm(TaskType::class, $task, ['method' => 'PATCH']);

        if ($request->isMethod('PATCH')) {
            if ($request->request->get($form->getName())['id']) {
                $id = $request->request->get($form->getName())['id'];
                $task = $em->getRepository(Task::class)->find($id);
                $form = $this->createForm(TaskType::class, $task, ['method' => 'PATCH']);
            }

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if (!$task->getId()) {
                    $task->setCreatedAt(new \DateTime);
                }
                
                $task->setUser($user);
                $em->persist($task);
                $em->flush();

                return $this->redirectToRoute('couple_todo');
            }
        }

        $taskList = $user->getTasks();
        $list = [];
        foreach ($taskList as $task) {
            $task->deleteForm = $this->createDeleteTaskForm($task)->createView();
            $list[$task->getDate()->format('Y-m-01')][] = $task;
        }

        return $this->render(
            'front/user/couple/todo.html.twig',
            [
                'form' => $form->createView(),
                'list' => $list
            ]
        );
    }

    public function budgetPlanner()
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $couple = $em->getRepository(Couple::class)->findOneByUser($user);
        $list = $couple->getBudgets();

        $couple->addBudget(new Budget);

        $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
        $newBudgetForm = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);

        return $this->render(
            'front/user/couple/budgetPlanner.html.twig',
            [
                'form' => $form->createView(),
                'newBudgetForm' => $newBudgetForm->createView(),
                'list' => $list
            ]
        );
    }

    public function updateBudget(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $couple = $em->getRepository(Couple::class)->findOneByUser($user);
        $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
        $this->processBudgetForm($form, $request, $em);

        return $this->redirectToRoute('couple_budget');
    }

    public function createBudget(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $couple = $em->getRepository(Couple::class)->findOneByUser($user);
        $couple->addBudget(new Budget);
        $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
        $this->processBudgetForm($form, $request, $em);

        return $this->redirectToRoute('couple_budget');
    }

    private function processBudgetForm($form, $request, $em)
    {
        if ($request->isMethod('PATCH')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            } else {
                // $form->getErrors(true, false);
            }
        }
    }

    public function deleteBudget($id, $itemId)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $couple = $em->getRepository(Couple::class)->findOneByUser($user);

        $budget = $em->getRepository(Budget::class)->findOneBy(['couple' => $couple, 'id' => $id]);
        if ($budget) {
            $budgetItem = $em->getRepository(BudgetItem::class)->findOneBy(['budget' => $budget, 'id' => $itemId]);

            if ($budgetItem) {
                $em->remove($budgetItem);
                // si budget vide le supprimer
                if ($budget->getItems()->count() === 1) {
                    $em->remove($budget);
                }
                $em->flush();
            }
        }
        
        return $this->redirectToRoute('couple_budget');
    }

    /**
     * @Route("/couple_wishlist", name="couple_wishlist")
     */
    public function wishlist()
    {
        return $this->render('UserBundle::Couple/wishlist.html.twig');
    }

    public function guestlist()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $couple = $em->getRepository(Couple::class)->findOneByUser($user);
        $list = $couple->getGuests();

        $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
        $newGuestForm = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);

        return $this->render(
            'front/user/couple/guestlist.html.twig',
            [
                'form' => $form->createView(),
                'newGuestForm' => $newGuestForm->createView(),
                'list' => $list
            ]
        );
    }

    public function updateGuest(Request $request)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $couple = $em->getRepository(Couple::class)->findOneByUser($user);
        $list = $couple->getGuests();

        $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);

        if ($request->isMethod('PATCH')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            } else {
                // $form->getErrors(true, false);
            }
            
            return $this->redirectToRoute('couple_guestlist');
        }


        return $this->render(
            'front/user/couple/guestlist.html.twig',
            [
                'form' => $form->createView(),
                'list' => $list
            ]
        );
    }

    public function createGuest(Request $request)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $couple = $em->getRepository(Couple::class)->findOneByUser($user);

        $couple->addGuest(new Guest);

        $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);

        if ($request->isMethod('PATCH')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            } else {
                //$form->getErrors(true, false);
            }
            
            return $this->redirectToRoute('couple_guestlist');
        }
    }

    public function deleteGuest($id)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $couple = $em->getRepository(Couple::class)->findOneByUser($user);

        $guest = $em->getRepository(Guest::class)->findOneBy(['couple' => $couple, 'id' => $id]);
        if ($guest) {
            $em->remove($guest);
            $em->flush();
        }
        
        return $this->redirectToRoute('couple_guestlist');
    }

    /**
     * Creates a form to delete a task entity.
     *
     * @param Task $task The task entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteTaskForm(Task $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete_task', array('id' => $task->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
