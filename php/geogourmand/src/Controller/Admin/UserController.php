<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin.users", methods={"GET"})
     */
    public function index(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render("Admin/User/index.html.twig", ["users"=> $users]);
    }

    /**
     * @Route("/admin/users/form/{id}", name="admin.users.form", methods={"GET", "POST"})
     */
    public function form($id = null, Request $request)
    {
        if ($id !== null){//si le user existe modification
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($id);
            if ($user === null){
                return $this->redirectToRoute("admin.users");
            }
        } else {// sinon creation
            $user = new User();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("admin.users");
        }

        return $this->render("Admin/User/form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/admin/users/delete/{id}", name="admin.users.delete")
     */
    public function delete($id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if($user !== null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute("admin.users");
    }
}