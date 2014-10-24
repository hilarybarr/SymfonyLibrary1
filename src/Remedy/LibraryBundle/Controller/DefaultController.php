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

use JMS\Serializer\Annotation\AccessType;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


use Remedy\LibraryBundle\Document\Book;



class DefaultController extends Controller


{

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
        $book->author=($in->author);
        $book->price=($in->price);
        $book->quantity=($in->quantity);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($book);
        $dm->flush();


        $response = new Response;
        $response->setContent($request->getContent());
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set('Content-Type', 'application/json');
        return $response;


    }

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










    public function updateAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $book = $dm->getRepository('RemedyLibraryBundle:Book')->find($id);


        $dm->remove($product);
        $dm->flush();

        return $this->redirect($this->generateUrl('show'));
    }


    public function deleteAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $book = $dm->getRepository('RemedyLibraryBundle:Book')->find($id);


        $book->setTitle('New book title!');
        $dm->flush();

        return $this->redirect($this->generateUrl('show'));
    }


    /**
     * @Route("/list")
     * @Template()
     * @return JsonResponse
     */
    public function listAction()

    {
        $books = array(
            ['title' => 'JavaScript for Dummies', 'author' => 'Remedy Partners', 'price' => 1.50, 'quantity' => 2],
            ['title' => 'The Raven', 'author' => 'Edgar Allan Poe', 'price' => 3.76, 'quantity' => 5],
            ['title' => 'PHP is Awesome', 'author' => 'Max', 'price' => 4.00, 'quantity' => 1],
            ['title' => 'Home', 'author' => 'Jodi Picoult', 'price' => 3.76, 'quantity' => 10],
            ['title' => 'The Scarlet Letter', 'author' => 'Nathaniel Hawthorne', 'price' => 6.00, 'quantity' => 1]
        );
        $response = new Response;
        $response->setContent(json_encode($books));
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

}

// ALTERNATIVE
///**
// * @Route("/list")
// * @Template()
// * @return JsonResponse
// */
//public function listAction()
//
//{
//    $request->request->get('json')
//
//        return new Response(json_encode(array('dataReceived' => $data));
//    //return rendered HTML page:
//     return $this->render('RemedyBundle:Default:list.html.twig', array(
//         'books' => $data));
//
//    }
//
//var books = { title : 'Book1', author: 'Me' };
//
//$.ajax({
//  type: "POST",
//  url: url,//post how you get this URL please...
//  data: {json : books},
//  success: function(response)
//  {
//      console.log(response);
//  }
//  error: function()
//{
//    console.log('an error occured');
//    console.log(arguments);//get debugging!
//}
//});
//
//