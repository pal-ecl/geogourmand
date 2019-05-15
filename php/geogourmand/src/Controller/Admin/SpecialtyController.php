<?php

namespace App\Controller\Admin;

use App\Entity\Specialty;
use App\Form\SpecialtyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpecialtyController extends AbstractController
{
    /**
     * @Route("/admin/specialties", name="admin.specialties", methods={"GET"})
     */
    public function index(){
        $specialties = $this->getDoctrine()->getRepository(Specialty::class)->findAll();
        return $this->render("Admin/Specialty/index.html.twig", ["specialties"=> $specialties]);
    }

    /**
     * @Route("/admin/specialties/form/{id}", name="admin.specialties.form", methods={"GET", "POST"})
     */
    public function form($id = null, Request $request)
    {
        if ($id !== null){//si le specialty existe modification
            $specialty = $this->getDoctrine()
                ->getRepository(Specialty::class)
                ->find($id);
            if ($specialty === null){
                return $this->redirectToRoute("admin.specialties");
            }
        } else {// sinon creation
            $specialty = new Specialty();
        }

        $form = $this->createForm(SpecialtyType::class, $specialty);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialty);
            $em->flush();

            return $this->redirectToRoute("admin.specialties");
        }

        return $this->render("Admin/Specialty/form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/admin/specialties/delete/{id}", name="admin.specialties.delete")
     */
    public function delete($id){
        $specialty = $this->getDoctrine()->getRepository(Specialty::class)->find($id);
        if($specialty !== null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($specialty);
            $em->flush();
        }

        return $this->redirectToRoute("admin.specialties");
    }
}