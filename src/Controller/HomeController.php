<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Projet;
use App\Form\CommentType;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjetRepository $projetRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'projects' => $projetRepository->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'app_show_project')]
    public function show(Projet $projet): Response
    {
        $comment = new Comment();

        return $this->render('home/show.html.twig', [
            'project' => $projet,
            'formComment'=>$this->createForm(CommentType::class, $comment)
        ]);
    }
}
