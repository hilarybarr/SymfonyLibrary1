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

class DefaultController extends Controller




{
    /**
     * @Route("/hey/{person}")
     * @Template()
     */
    public function indexAction($person)
    {
        return array('person' => $person);
    }




    /**
     * @Route("/list")
     * @Template()
     * @return JsonResponse
     */
    public function listAction()

    {
        $books = array(
            ['title' => 'JavaScript for Dummies', 'author' => 'Remedy Partners', 'price'=> 1.50, 'quantity' => 2] ,
            ['title' => 'The Raven', 'author'=>'Edgar Allan Poe', 'price'=> 3.76, 'quantity' => 5],
            ['title' => 'PHP is Awesome', 'author'=>'Max', 'price'=> 4.00, 'quantity' => 1],
            ['title' => 'Home', 'author'=>'Jodi Picoult', 'price'=> 3.76, 'quantity' => 10],
            ['title' => 'The Scarlet Letter', 'author'=>'Nathaniel Hawthorne', 'price'=> 6.00, 'quantity' => 1]
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
