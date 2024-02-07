<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Repository\AutorRepository;
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

    #[Route('/ap3/{palabra}', name: 'ap3')]
    public function ap3(LibroRepository $libroRepository, string $palabra): Response
    {
        $libros = $libroRepository->findByPalabraTitulo($palabra);
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/ap4', name: 'ap4')]
    public function ap4(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findBySinLetraEditorial('a');
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/ap5', name: 'ap5')]
    public function ap5(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findUnAutor();
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/ap6', name: 'ap6')]
    public function ap6(AutorRepository $autorRepository): Response
    {
        $autores = $autorRepository->findOrderByEdad();
        return $this->render('autor/ap6.html.twig', [
            'autores' => $autores
        ]);
    }

    #[Route('/ap7', name: 'ap7')]
    public function ap7(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findOrderByTituloOptimizado();
        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/ap8', name: 'ap8')]
    public function ap8(LibroRepository $libroRepository): Response
    {
        $libros = $libroRepository->findOrderByTituloOptimizado();
        return $this->render('libro/ap8.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/ap8/{id}', name: 'ap8_autores')]
    public function ap8Autores(AutorRepository $autorRepository, Libro $libro): Response
    {
        $autores = $autorRepository->findByLibroOrderByApellidosNombre($libro);
        return $this->render('autor/ap8.html.twig', [
            'autores' => $autores
        ]);
    }
}
