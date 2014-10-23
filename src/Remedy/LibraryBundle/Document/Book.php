<?php
namespace Remedy\LibraryBundle\Document;
use JMS\Serializer\Annotation\AccessType;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */

class Book
{
    /**
     * @MongoDB\Id
     */
    public $id;

    /**
     * @MongoDB\String
     */
    public $title;

    /**
     * @MongoDB\String
     */
    public $author;

    /**
     * @MongoDB\Float
     */
    public $price;

    /**
     * @MongoDB\Int
     */
    public $quantity;

//
//    /**
//     * Get id
//     *
//     * @return id $id
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * Set title
//     *
//     * @param string $title
//     * @return self
//     */
//    public function setTitle($title)
//    {
//        $this->title = $title;
//        return $this;
//    }
//
//    /**
//     * Get title
//     *
//     * @return string $title
//     */
//    public function getTitle()
//    {
//        return $this->title;
//    }
//
//    /**
//     * Set author
//     *
//     * @param string $author
//     * @return self
//     */
//    public function setAuthor($author)
//    {
//        $this->author = $author;
//        return $this;
//    }
//
//    /**
//     * Get author
//     *
//     * @return string $author
//     */
//    public function getAuthor()
//    {
//        return $this->author;
//    }
//
//    /**
//     * Set price
//     *
//     * @param float $price
//     * @return self
//     */
//    public function setPrice($price)
//    {
//        $this->price = $price;
//        return $this;
//    }
//
//    /**
//     * Get price
//     *
//     * @return float $price
//     */
//    public function getPrice()
//    {
//        return $this->price;
//    }
//
//    /**
//     * Set quantity
//     *
//     * @param int $quantity
//     * @return self
//     */
//    public function setQuantity($quantity)
//    {
//        $this->quantity = $quantity;
//        return $this;
//    }
//
//    /**
//     * Get quantity
//     *
//     * @return int $quantity
//     */
//    public function getQuantity()
//    {
//        return $this->quantity;
//    }



//    public function getArray(){
//        return array(
//            'id'=>$this->getId(),
//        );
//    }
}
