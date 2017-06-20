<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/05/17
 * Time: 14:56
 */

namespace Miky\Bundle\CategoryBundle\Doctrine;


use Doctrine\ORM\EntityManager;
use Miky\Bundle\CoreBundle\Doctrine\AbstractObjectManager;

class CategoryManager extends AbstractObjectManager
{

    public function __construct(EntityManager $em, $class){
        parent::__construct($em, $class);
    }

    public function getCategories(){
        return $this->getRepository()->findAll();
    }

    public function getCategory($id){
        return $this->getRepository()->find($id);
    }
}