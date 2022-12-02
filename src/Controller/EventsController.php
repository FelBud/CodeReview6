<?php
namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EventsRepository;

use App\Entity\Events;
use App\Form\EventsType;


class EventsController extends AbstractController
{
  #[Route('/', name: 'events')]
  public function index(ManagerRegistry $doctrine): Response
  {
    $events = $doctrine->getRepository(Events::class)->findAll();

    return $this->render('events/index.html.twig', ['events' => $events]);
  }
  
  #[Route('/create', name: 'events_create')]
  public function create(Request $request, ManagerRegistry $doctrine): Response
  {
      $events = new Events();
      $form = $this->createForm(EventsType::class, $events);

      $form->handleRequest($request);


      if ($form->isSubmitted() && $form->isValid()) {
          


          $events = $form->getData();
          
          $em = $doctrine->getManager();
          $em->persist($events);
          $em->flush();

          $this->addFlash(
              'notice',
              'Event Added'
              );
    
          return $this->redirectToRoute('events');
      }

    return $this->render('events/create.html.twig', ['form' => $form->createView()]);
  }

  
#[Route('/edit/{id}', name: 'events_edit')]
public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
{
    $events = $doctrine->getRepository(Events::class)->find($id);
    $form = $this->createForm(EventsType::class, $events);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $events = $form->getData();
        
        $em = $doctrine->getManager();
        $em->persist($events);
        $em->flush();
        $this->addFlash(
             'notice',
             'Event Edited'
             );

        return $this->redirectToRoute('events');
    }

    return $this->render('events/edit.html.twig', ['form' => $form->createView()]);
}

  #[Route('/details/{id}', name: 'events_details')]
  public function details(ManagerRegistry $doctrine, $id): Response
  {
      $events = $doctrine->getRepository(Events::class)->find($id);

      return $this->render('events/details.html.twig', ['events' => $events]);
  }

  #[Route('/delete/{id}', name: 'delete_events')]
  public function delete(ManagerRegistry $doctrine, $id){
    $em = $doctrine->getManager();
    $events = $em->getRepository(Events::class)->find($id);
    $em->remove($events);
    
    $em->flush();
    $this->addFlash(
        'notice',
        'Event Removed'
    );
    
    return $this->redirectToRoute('events');
}

#[Route('/about', name: 'about')]
   public function about(): Response
   {
       return $this->render('events/about.html.twig', [
           'controller_name' => 'EventsController',
       ]);
   } 
   

   #[Route('/contact', name: 'contact')]
   public function contact(): Response
   {
       return $this->render('events/contact.html.twig', [
           'controller_name' => 'EventsController',
       ]);
   }

  }