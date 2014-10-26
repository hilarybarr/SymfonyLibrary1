<?php

namespace Remedy\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



use Remedy\LibraryBundle\Document\Book;



class DefaultController extends Controller


{


    /**
     * @Route("/show")
     */
    public function showAction()
    {
        $repository = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('RemedyLibraryBundle:Book');

        $books = $repository->findAll();
        $response = new Response;
        $response->setContent(json_encode($books));
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }



//NEED TO SPECIFY POST METHOD
    /**
     * @Route("/create")
     *
     */
    public function createAction(Request $request)

    {
        $in = json_decode($request->getContent());


        $book = new Book();
        $book->title = ($in->title);
        $book->author = ($in->author);
        $book->price = ($in->price);
        $book->quantity = ($in->quantity);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($book);
        $dm->flush();


        $response = new Response;
        $response->setContent($request->getContent());
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set('Content-Type', 'application/json');
        return $response;


    }



//
    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $book = $dm->getRepository('RemedyLibraryBundle:Book')->find($id);

        $dm->remove($book);
        $dm->flush();
    }


//
//
//
//
//    public function updateAction($id)
//    {
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $book = $dm->getRepository('RemedyLibraryBundle:Book')->find($id);
//
//
//        $dm->remove($product);
//        $dm->flush();
//
//        return $this->redirect($this->generateUrl('show'));
//    }

}