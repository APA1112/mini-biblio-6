<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\SocioType;
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocioController extends AbstractController
{
    #[Route('/socio/listar', name: 'socio_listar')]
    public function sociLister(SocioRepository $socioRepository) : Response
    {
        $socios = $socioRepository->findAll();
        return $this->render('socio/index.html.twig', [
            'socios' => $socios
        ]);
    }

    #[Route('/socio/modificar/{id}', name: 'socio_modificar')]
    public function modSocio(Request $request, Socio $socio, SocioRepository $socioRepository) : Response
    {
        $form = $this->createForm(SocioType::class, $socio);

        $form->handleRequest($request);

        $nuevo = $socio->getId()===null;

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $socioRepository->save();
                if ($nuevo) {
                    $this->addFlash('success', 'Socio creado con éxito');
                } else {
                    $this->addFlash('success', 'Cambios guardados con éxito');
                }
                return $this->redirectToRoute('socio_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('socio/modificar.html.twig', ['form' => $form->createView(), 'socio'=>$socio]);
    }

    #[Route('/socio/elimiar/{id}', name: 'socio_eliminar')]
    public function delSocio(Request $request, SocioRepository $socioRepository, Socio $socio) : Response {
        if ($request->request->has('confirmar')) {
            try {
                $socioRepository->remove($socio);
                $socioRepository->save();
                $this->addFlash('success', 'Socio eliminado con éxito');
                return $this->redirectToRoute('socio_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se ha podido eliminar el socio');
            }
        }
        return $this->render('socio/eliminar.html.twig', ['socio'=>$socio]);
    }

    #[Route('/socio/nuevo', name: 'socio_nuevo')]
    public function addSocio(Request $request, SocioRepository $socioRepository) : Response
    {
        $socio = new Socio();
        $socioRepository->add($socio);

        return $this->modSocio($request, $socio, $socioRepository);
    }
}