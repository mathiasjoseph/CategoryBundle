<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/05/17
 * Time: 14:05
 */

namespace Miky\Bundle\CategoryBundle\Provider;


class CategoryProvider
{
    public function getClassParameterName($alias){
        return "miky_category.model.categorie_".$alias.".class";
    }

    public function getManagerServiceName($alias){
        return "miky_category.categorie_".$alias."_manager";
    }
}