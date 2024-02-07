<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultasController extends AbstractController
{
    #[Route('/ap1', name: 'ap1')]
    public function ap1(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findOrderByTitulo();
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/ap2', name: 'ap2')]
    public function ap2(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findOrderByAnioPublicacionDesc();
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }
}
