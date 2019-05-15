<?php
/**
 * Created by PhpStorm.
 * User: Wizpaul
 * Date: 23/04/2019
 * Time: 10:06
 */

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin.categories")
     */
    public function index()
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render("Admin/Category/index.html.twig",
            ["categories"=> $categories]);
    }

    /**
     * @Route("/admin/category/form/{id}", name="admin.categories.form")
     */
    public function form($id = null, Request $request)
    {
        if ($id !== null) {
            $category = $this
                ->getDoctrine()
                ->getRepository(Category::class)
                ->find($id);
            if ($category === null) {
                return $this->redirectToRtoute("admin.categories");
            }
        } else {
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("admin.categories");
        }

        //gestion formulaire
        return $this->render("Admin/Category/form.html.twig",
            ["form"=>$form->createView()]);
    }

    /**
     * @Route("/admin/category/delete/{id}", name="admin.categories.delete")
     */
    public function delete($id)
    {
        $category = $this
            ->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        if ($category !== null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }
        return $this->redirectToRoute("admin.categories");
    }
}