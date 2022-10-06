<?php

namespace App\EventListener;

use App\Entity\ProductItem;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class ProductItemQuantitySubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents(): array
    {
        return[
            //add quantity
            Events::postPersist,

            //remove quantity
            Events::postRemove,

            //Two alternatives: add the difference or recalculate the total quantity
            //Events::postUpdate
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if($entity instanceof ProductItem)
        {
            $quantity = $entity->getQuantity();
            $currentTotalQuantity = $entity->getProduct()->getTotalQuantity();


            $updatedTotalQuantity = $quantity + $currentTotalQuantity;

            $entity->getProduct()->setTotalQuantity($updatedTotalQuantity);

            $args->getObjectManager()->flush();

        }
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if($entity instanceof ProductItem)
        {
            $quantity = $entity->getQuantity();
            $currentTotalQuantity = $entity->getProduct()->getTotalQuantity();

            $updatedTotalQuantity = $currentTotalQuantity - $quantity;

            $entity->getProduct()->setTotalQuantity($updatedTotalQuantity);

            $args->getObjectManager()->flush();
        }
    }

}