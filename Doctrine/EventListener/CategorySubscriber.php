<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 18/08/16
 * Time: 22:02
 */

namespace Miky\Bundle\CategoryBundle\Doctrine\EventListener;


use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Miky\Bundle\CategoryBundle\Model\Category;


class CategorySubscriber implements EventSubscriber
{

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        // the $metadata is the whole mapping info for this class
        $metadata = $eventArgs->getClassMetadata();
        if (!in_array(Category::class, class_parents($metadata->getName()))) {
            return;
        }

        $builder = new ClassMetadataBuilder($metadata);
        $builder
            ->createOneToMany("children", $metadata->getName())
            ->mappedBy("parent")
            ->cascadeAll()
            ->build();
        $builder
            ->createManyToOne("parent", $metadata->getName())
            ->cascadeAll()
            ->inversedBy("children")
            ->build();
    }

}