<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Specialty;
use App\Form\OptionsType;

Class AppController extends AbstractController{

    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        return $this->render("App/home.html.twig",
            [
                "pageTitle"=>"Géogourmand"
            ]
        );
    }

    /**
     * @Route("/specialties", name="specialties")
     */
    public function specialties()
    {

        $specialties = $this
            ->getDoctrine()
            ->getRepository(Specialty::class)
            ->findSpecialties();

        return $this->render("Elements/specialties.html.twig",
            [
                "pageTitle"=>"Géogourmand specialitées",
                "specialties" =>$specialties
            ]
        );
    }

    /**
     * @Route("/options", name="options")
     */
    public function options()
    {
        $form = $this->createForm(OptionsType::class);
        return $this->render("Elements/options.html.twig",
            [
                "pageTitle"=>"Géogourmand options",
                "form" => $form->createView()
            ]
        );
    }

    public function redirectAction()
    {
        return $this->redirectToRoute("homepage");
    }
}