<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/05/17
 * Time: 14:56
 */

namespace Miky\Bundle\CategoryBundle\Doctrine;


use Doctrine\ORM\EntityManager;
use Miky\Bundle\CoreBundle\Doctrine\BaseEntityManager;

class CategoryManager extends BaseEntityManager
{

    public function __construct(EntityManager $em, $class){
        parent::__construct($em, $class);
    }

    public function getCategories(){
        return $this->getRepository()->findAll();
    }
    public function getCategoriesByAsCategoryGroup(){
        return $this->getRepository()->findBy(array("asCategoryGroup" => true), array("name" => 'ASC'));
    }

    public function getCategory($id){
        return $this->getRepository()->find($id);
    }
}