<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/05/17
 * Time: 14:05
 */

namespace Miky\Bundle\CategoryBundle\Provider;


use Miky\Bundle\CategoryBundle\Doctrine\CategoryManager;
use Miky\Component\Category\Metadata\CategoryRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CategoryProvider
{
    /**
     * @var CategoryRegistry
     */
    private $registry;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * CategoryProvider constructor.
     * @param CategoryRegistry $registry
     */
    public function __construct(CategoryRegistry $registry)
    {
        $this->registry = $registry;
    }


    public function createCategory($alias){
        return $this->getManager($alias)->createEntity();
    }

    /**
     * @return CategoryManager $manager
     */
    public function getManager($alias){
        /** @var CategoryManager $manager */
        $manager = $this->container->get($this->registry->get($alias)->getManagerServiceId());
        return $manager;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}