<?php

namespace App\EventListener;

use App\Entity\ProductItem;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

class ProductItemQuantitySubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents(): array
    {
        return[
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
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

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if($entity instanceof ProductItem)
        {
            $productItems = $entity->getProduct()->getProductItems();
            $totalQuantity = 0;

            foreach ($productItems as $productItem){

                if($productItem->getId() !== $entity->getId()){
                    $totalQuantity += $productItem->getQuantity();
                } else {
                    $totalQuantity += $entity->getQuantity();
                }
            }

            $entity->getProduct()->setTotalQuantity($totalQuantity);

            $args->getObjectManager()->flush();
        }
    }
}