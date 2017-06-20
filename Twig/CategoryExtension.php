<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/06/17
 * Time: 15:48
 */

namespace Miky\Bundle\CategoryBundle\Twig;


use Miky\Bundle\CategoryBundle\Provider\CategoryProvider;

class CategoryExtension extends \Twig_Extension
{
    /**
     * @var CategoryProvider
     */
    private $categoryProvider;


    public function __construct(CategoryProvider $categoryProvider)
    {
        $this->categoryProvider = $categoryProvider;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('miky_category_get_categories', array($this, 'getCategories')),
        );
    }

    public function getCategories($alias)
    {
        $categories = $this->categoryProvider->getManager($alias)->getCategories();
        return $categories;
    }
}