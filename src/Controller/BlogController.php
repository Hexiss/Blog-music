<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="homme")
     */
    public function home() {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function categorie() {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repo->findAll();

        return $this->render('blog/categorie.html.twig', [
        'categories' => $categories
        ]); 
    }

    /**
     * @Route("/nouveau", name="nouveau")
     * @Route("/{id}/modifier", name="modifier")
     */
    public function form(Categorie $article = null, Request $request) {
        $manager = $this->getDoctrine()->getManager();

        if(!$article) {
            $article = new Categorie();
        }

        $form = $this->createFormBuilder($article)
                     ->add('titre')
                     ->add('contenu')
                     ->add('image')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()){
            $article->setCreeLe(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('nouveau', ['id' => $article->getId()]);
        }

        return $this->render('blog/nouveau.html.twig',[
            'form' => $form->createView(),
            'editMode' => $article->getId() !==null
        ]);
        }

    /**
     * @Route("/categorie/{id}", name="cours")
     */
    public function show($id) {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->find($id);
        return $this->render('blog/cours.html.twig', [
            'article' => $categorie
    ]);
    }
}