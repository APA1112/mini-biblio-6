<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route(path: '/entrar', name: 'app_login')]
    public function login(): Response{
        return $this->render('security/login.html.twig');
    }

    #[Route(path: '/salir', name: 'app_logout')]
    public function logout():void{
        throw new \LogicException('Esto no deberia ejecutarse nunca');
    }
}