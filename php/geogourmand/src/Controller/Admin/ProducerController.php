<?php

namespace App\Controller\Admin;

use App\Entity\Producer;
use App\Form\ProducerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProducerController extends AbstractController
{
    /**
     * @Route("/admin/producers", name="admin.producers", methods={"GET"})
     */
    public function index(){
        $producers = $this->getDoctrine()->getRepository(Producer::class)->findAll();
        return $this->render("Admin/Producer/index.html.twig", ["producers"=> $producers]);
    }

    /**
     * @Route("/admin/producers/form/{id}", name="admin.producers.form", methods={"GET", "POST"})
     */
    public function form($id = null, Request $request)
    {
        if ($id !== null){//si le producer existe modification
            $producer = $this->getDoctrine()
                ->getRepository(Producer::class)
                ->find($id);
            if ($producer === null){
                return $this->redirectToRoute("admin.producers");
            }
        } else {// sinon creation
            $producer = new Producer();
        }

        $form = $this->createForm(ProducerType::class, $producer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($producer);
            $em->flush();

            return $this->redirectToRoute("admin.producers");
        }

        return $this->render("Admin/Producer/form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/admin/producers/delete/{id}", name="admin.producers.delete")
     */
    public function delete($id){
        $producer = $this->getDoctrine()->getRepository(Producer::class)->find($id);
        if($producer !== null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($producer);
            $em->flush();
        }

        return $this->redirectToRoute("admin.producers");
    }
}