<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="site-home")
     */
    public function index()
    {
        return $this->render('site/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/rooms", name="site-rooms")
     */
    public function rooms(){
        return $this->render('site/home/rooms.html.twig');
    }

    /**
     * @Route("/gallery", name="site-gallery")
     */
    public function gallery(){
        return $this->render('site/home/gallery.html.twig');
    }

    /**
     * @Route("/surroundings", name="site-surroundings")
     */
    public function surroundings(){
        return $this->render('site/home/surroundings.html.twig');
    }


}
