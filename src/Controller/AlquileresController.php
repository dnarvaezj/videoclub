<?php

namespace App\Controller;

use App\Entity\Alquileres;
use App\Entity\PeliculasAlquileres;
use App\Form\AlquileresType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AlquileresController extends AbstractController
{
    #[Route('/alquileres', name: 'app_alquileres')]
    public function getAlquileres(ManagerRegistry $doctrine): Response {

        // $listAlquileres = $doctrine->getRepository(Alquileres::class)->findBy([], ['fechaFin' => 'ASC']);

        $listAlquileres = $doctrine->getRepository(Alquileres::class)->findUsersJoinedToAlquileres();
        
        return $this->render('alquileres/index.html.twig',[ 'listAlquileres' => $listAlquileres ]);
    }

    #[Route('/alquileres/create', name: 'app_alquileres_create')]
    public function createAlquileres(Request $request, ManagerRegistry $doctrine) {

        $entityManager = $doctrine->getManager();
        $alquileres = new Alquileres();
        $form_alquileres = $this->createForm(AlquileresType::class, $alquileres);
        $form_alquileres->handleRequest($request);

        if ($form_alquileres->isSubmitted() && $form_alquileres->isValid()) {

            $fechaInicio = date('Y-m-d h:i:s');
            $diasalquiler = $form_alquileres->get('diasalquiler')->getData();

            echo $fechaInicio.'\n';
            echo $diasalquiler.' | ';
            echo gettype($diasalquiler).' | ';

            $fechaFin = date('Y-m-d h:i:s',strtotime($fechaInicio."+ $diasalquiler days"));
            $fechaInicio = \DateTime::createFromFormat('Y-m-d h:i:s', $fechaInicio);
            $fechaFin = \DateTime::createFromFormat('Y-m-d h:i:s', $fechaFin);

            $alquileres->setfechaInicio($fechaInicio);
            $alquileres->setfechaFin($fechaFin);

            $entityManager->persist($alquileres);
            $entityManager->flush();

            return $this->redirectToRoute('app_alquileres');
        }

        return $this->render('/alquileres/alquileresCreate.html.twig', [
            'form_alquileres' => $form_alquileres
        ]);
    }

    #[Route('/alquileres/update/{id}', name: 'app_alquileres_update')]
    public function updateAlquileres(ManagerRegistry $doctrine, Request $request, $id) {

        $entityManager = $doctrine->getManager();
        $getPelicula = $doctrine->getRepository(Alquileres::class)->find($id);
        $form_alquileres = $this->createForm(AlquileresType::class, $getPelicula);
        $form_alquileres->handleRequest($request);

        if ($form_alquileres->isSubmitted() && $form_alquileres->isValid()) {
            $entityManager->persist($getPelicula);
            $entityManager->flush();

            return $this->redirectToRoute('app_alquileres');
        }

        return $this->render('/alquileres/alquileresUpdate.html.twig', [
            'form_alquileres' => $form_alquileres
        ]);
    }

    #[Route('/alquileres/delete/{id}', name: 'app_alquileres_delete')]
    public function deleteAlquileres(ManagerRegistry $doctrine, $id) {

        $entityManager = $doctrine->getManager();
        $getPelicula = $doctrine->getRepository(Alquileres::class)->find($id);
        $entityManager->remove($getPelicula);
        $entityManager->flush();

        return $this->redirectToRoute('app_alquileres');
    }
}
