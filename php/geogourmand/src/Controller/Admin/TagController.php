<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/admin/tags", name="admin.tags", methods={"GET"})
     */
    public function index(){
        $tags = $this->getDoctrine()->getRepository(Tag::class)->findAll();
        return $this->render("Admin/Tag/index.html.twig", ["tags"=> $tags]);
    }

    /**
     * @Route("/admin/tags/form/{id}", name="admin.tags.form", methods={"GET", "POST"})
     */
    public function form($id = null, Request $request)
    {
        if ($id !== null){//si le tag existe modification
            $tag = $this->getDoctrine()
                ->getRepository(Tag::class)
                ->find($id);
            if ($tag === null){
                return $this->redirectToRoute("admin.tags");
            }
        } else {// sinon creation
            $tag = new Tag();
        }

        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute("admin.tags");
        }

        return $this->render("Admin/Tag/form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/admin/tags/delete/{id}", name="admin.tags.delete")
     */
    public function delete($id){
        $tag = $this->getDoctrine()->getRepository(Tag::class)->find($id);
        if($tag !== null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute("admin.tags");
    }
}