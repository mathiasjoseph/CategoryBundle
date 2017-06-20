<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/05/17
 * Time: 14:05
 */

namespace Miky\Bundle\CategoryBundle\Model;


use Miky\Component\Resource\Model\ResourceInterface;

class Category extends \Miky\Component\Category\Model\Category implements ResourceInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}