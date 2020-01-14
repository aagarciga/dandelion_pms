<?php

namespace App\Controller;

use App\Entity\RoomType;
use App\Form\RoomTypeType;
use App\Repository\RoomTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room/type")
 */
class RoomTypeController extends AbstractController
{
    /**
     * @Route("/", name="room_type_index", methods={"GET"})
     */
    public function index(RoomTypeRepository $roomTypeRepository): Response
    {
        return $this->render('room_type/index.html.twig', [
            'room_types' => $roomTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="room_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $roomType = new RoomType();
        $form = $this->createForm(RoomTypeType::class, $roomType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($roomType);
            $entityManager->flush();

            return $this->redirectToRoute('room_type_index');
        }

        return $this->render('room_type/new.html.twig', [
            'room_type' => $roomType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_type_show", methods={"GET"})
     */
    public function show(RoomType $roomType): Response
    {
        return $this->render('room_type/show.html.twig', [
            'room_type' => $roomType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RoomType $roomType): Response
    {
        $form = $this->createForm(RoomTypeType::class, $roomType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_type_index');
        }

        return $this->render('room_type/edit.html.twig', [
            'room_type' => $roomType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RoomType $roomType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roomType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($roomType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room_type_index');
    }
}
