<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Form\LibroType;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/libro/autores/{id}', name: 'libro_autores')]
    public function autores(Libro $libro): Response
    {
        return $this->render('libro/autores.html.twig', [
            'libro' => $libro,
            'autores' => $libro->getAutores()
        ]);
    }

    #[Route('/libro/modificar/{id}', name: 'libro_modificar')]
    public function modificar(Request $request, Libro $libro, LibroRepository $libroRepository): Response
    {
        $form = $this->createForm(LibroType::class, $libro);

        $form->handleRequest($request);

        $nuevo = $libro->getId() === null;

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $libroRepository->save();
                if ($nuevo) {
                    $this->addFlash('success', 'Libro creado con éxito');
                } else {
                    $this->addFlash('success', 'Cambios guardados con éxito');
                }
                return $this->redirectToRoute('libro_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('libro/modificar.html.twig', ['form' => $form->createView(), 'libro'=>$libro]);
    }

    #[Route('/libro/eliminar/{id}', name: 'libro_eliminar')]
    public function eliminar(Request $request, LibroRepository $libroRepository, Libro $libro): Response
    {
        if ($request->request->has('confirmar')) {
            try {
                $libroRepository->remove($libro);
                $libroRepository->save();
                $this->addFlash('success', 'Libro eliminado con éxito');
                return $this->redirectToRoute('libro_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se ha podido eliminar el libro');
            }
        }

        return $this->render('libro/eliminar.html.twig', ['libro' => $libro]);
    }

    #[Route('/libro/nuevo', name: 'libro_nuevo')]
    public function nuevo(Request $request, LibroRepository $libroRepository): Response
    {
        $libro = new Libro();
        $libroRepository->add($libro);

        return $this->modificar($request, $libro, $libroRepository);
    }
}
