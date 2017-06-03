<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/06/17
 * Time: 01:07
 */

namespace Miky\Bundle\CategoryBundle\DependencyInjection\Compiler;


use Miky\Bundle\CategoryBundle\Doctrine\CategoryManager;
use Miky\Component\Category\Metadata\CategoryMetadata;
use Miky\Component\Category\Metadata\CategoryRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class RegisterCategoriesPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        try {
            $categories = $container->getParameter('miky_category.categories');
            $registry = $container->findDefinition('miky_category.category_registry');
        } catch (InvalidArgumentException $exception) {
            return;
        }

        foreach ($categories as $alias => $configuration) {
            $registry->addMethodCall('addFromAliasAndConfiguration', [$alias, $configuration]);
        }
        $this->addServices($container, $container->get('miky_category.category_registry'));
        $this->addResources($container, $container->get('miky_category.category_registry'));
    }
    
    private function addServices(ContainerBuilder $container, CategoryRegistry $registry){
        foreach ($registry->getAll() as $alias => $metadata) {
            /** @var CategoryMetadata $metadata */
           $container->setParameter($metadata->getClassParameterId(), $metadata->getModelClass());
           $definition = new Definition(CategoryManager::class);
           $definition->addArgument($container->findDefinition("doctrine.orm.entity_manager"));
           $definition->addArgument($container->getParameter($metadata->getClassParameterId()));
           if ($metadata->getManagerServiceId() == null){
               $container->setDefinition($metadata->getFormattedManagerServiceId(), $definition);
           }
        }
    }

    private function addResources(ContainerBuilder $container, CategoryRegistry $registry){
        $resourceRegistry = $container->findDefinition('miky.resource_registry');
        foreach ($registry->getAll() as $alias => $metadata) {
            /** @var CategoryMetadata $metadata */
            if ($metadata->hasResource()){
                $resource = $metadata->getResource();
            }else{
                $resource = array();
            }

            $resourceRegistry->addMethodCall('addFromAliasAndConfiguration', [$metadata->getResourceAlias(), $resource]);

        }
    }
}