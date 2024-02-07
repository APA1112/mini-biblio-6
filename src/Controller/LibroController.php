<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibroController extends AbstractController
{
    #[Route('/libro/listar', name: 'libro_listar')]
    public function index(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findAll();
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }
}
