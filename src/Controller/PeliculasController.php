<?php

namespace App\Controller;

use App\Entity\Peliculas;
use App\Form\PeliculasType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PeliculasController extends AbstractController
{
    #[Route('/peliculas', name: 'app_peliculas')]
    public function getPeliculas(ManagerRegistry $doctrine): Response {

        $listPeliculas = $doctrine->getRepository(Peliculas::class)->findBy([], ['nombre' => 'ASC']);
        return $this->render('peliculas/index.html.twig',[ 'listPeliculas' => $listPeliculas ]);
    }

    #[Route('/peliculas/create', name: 'app_peliculas_create')]
    public function createPeliculas(Request $request, ManagerRegistry $doctrine) {

        $entityManager = $doctrine->getManager();
        $peliculas = new Peliculas();
        $form_peliculas = $this->createForm(PeliculasType::class, $peliculas);
        $form_peliculas->handleRequest($request);

        if ($form_peliculas->isSubmitted() && $form_peliculas->isValid()) {

            $now = intval(date('Y'));
            // $now = $now->format('Y');

            echo gettype($now);

            $fechaestreno = $form_peliculas->get('fechaestreno')->getData();
            $anoestreno = intval($fechaestreno->format('Y'));
            // $fechaestreno = date('Y',$fechaestreno);

            echo gettype($anoestreno);

            if ($now-2 <= $anoestreno) {
                $tipo = 'Nueva';
            } elseif ($now-2 > $anoestreno and $anoestreno > 2000) {
                $tipo = 'Normal';
            } elseif ($anoestreno < 2000) {
                $tipo = 'Vieja';
            }

            $peliculas->setTipo($tipo);
            
            $entityManager->persist($peliculas);
            $entityManager->flush();

            return $this->redirectToRoute('app_peliculas');
        }

        return $this->render('/peliculas/peliculasCreate.html.twig', [
            'form_peliculas' => $form_peliculas
        ]);
    }

    #[Route('/peliculas/update/{id}', name: 'app_peliculas_update')]
    public function updatePeliculas(ManagerRegistry $doctrine, Request $request, $id) {

        $entityManager = $doctrine->getManager();
        $getPelicula = $doctrine->getRepository(Peliculas::class)->find($id);
        $form_peliculas = $this->createForm(PeliculasType::class, $getPelicula);
        $form_peliculas->handleRequest($request);

        if ($form_peliculas->isSubmitted() && $form_peliculas->isValid()) {
            $entityManager->persist($getPelicula);
            $entityManager->flush();

            return $this->redirectToRoute('app_peliculas');
        }

        return $this->render('/peliculas/peliculasUpdate.html.twig', [
            'form_peliculas' => $form_peliculas
        ]);
    }

    #[Route('/peliculas/delete/{id}', name: 'app_peliculas_delete')]
    public function deletePeliculas(ManagerRegistry $doctrine, $id) {

        $entityManager = $doctrine->getManager();
        $getPelicula = $doctrine->getRepository(Peliculas::class)->find($id);
        $entityManager->remove($getPelicula);
        $entityManager->flush();

        return $this->redirectToRoute('app_peliculas');
    }

}
