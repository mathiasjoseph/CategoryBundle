<?php

namespace Miky\Bundle\CategoryBundle\DependencyInjection;

use Miky\Bundle\CategoryBundle\Doctrine\CategoryManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MikyCategoryExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $this->loadCategories($config['categories'], $container);
    }

    private function loadCategories(array $categories, ContainerBuilder $container)
    {
        $categoryProvider = $container->get("miky_category.provider.category");

//        foreach ($categories as $alias => $categoryConfig) {
//            $container->setParameter($categoryProvider->getClassParameterName($alias), $categoryConfig["class"]);
//            if ($categoryConfig["manager"] == null){
//                $definition = new Definition(CategoryManager::class);
//            }else{
//                if (!in_array(CategoryManager::class, class_implements(get_class($categoryConfig["manager"])))) {
//                   throw new Exception(get_class($categoryConfig["manager"]) . "must be extends" . CategoryManager::class, 500);
//                }else{
//                    $definition = new Definition($categoryConfig["manager"]);
//                }
//            }
//
//            $definition->addArgument($container->get("doctrine.orm.entity_manager"));
//            $definition->addArgument($container->getParameter($categoryProvider->getClassParameterName($alias)));
//            $container->setDefinition($categoryProvider->getManagerServiceName($alias), $definition);
//        }
    }
}
