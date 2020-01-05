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
     * @Route("/gallery", name="site-gallery")
     */
    public function gallery(){
        return $this->render('site/gallery/gallery.html.twig');
    }

    /**
     * @Route("/surroundings", name="site-surroundings")
     */
    public function surroundings(){
        return $this->render('site/surroundings/surroundings.html.twig');
    }

    /**
     * @Route("/getintouch", name="site-contact-us")
     */
    public function contactUs(){
        return $this->render('site/contact-us/contact-us.html.twig');
    }


}
