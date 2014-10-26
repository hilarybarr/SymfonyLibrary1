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



//NEED TO SPECIFY POST @METHOD
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



//NEED TO SPECIFY DELETE @METHOD
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




//NEED TO SPECIFY UPDATE @METHOD
    /**
     * @Route("/update/{id}")
     */
    public function updateAction(Request $request)
    {

        $in = json_decode($request->getContent());


        $dm = $this->get('doctrine_mongodb')->getManager();
        $book = $dm->getRepository('RemedyLibraryBundle:Book')->find($in->id);
        $book->title = ($in->title);
        $book->author = ($in->author);
        $book->price = ($in->price);
        $book->quantity = ($in->quantity);

        $dm->persist($book);
        $dm->flush();


        $response = new Response;
        $response->setContent($in);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}




//ADDING AN INCREMENTING INDEX IN MONGO..For some reason the id wasn't accessible to Angular at first but then it was
//so an index wasn't needed.
//// first time
//bookIndex = 0;
//db.Book.find().forEach(
//function(curBook){
//    db.Book.update({_id:curBook._id}, {$set:{ index: bookIndex}})
//		++bookIndex;
//
//	}
//)
//
//
//// new insert
//lastBook = db.Book.find().sort({_id:-1}).limit(1);
//numBooks = db.Book.find().count();
//db.Book.update({_id:lastBook._id}, {$set:{ index: numBooks}})