<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductItem;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PantryController extends AbstractController
{
    #[Route('/')]
    public function show(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findBy([], ['name' => 'ASC']);

        return $this->render('pantry/pantryGrid.html.twig',
            ['products' => $products]
        );
    }

    #[Route('/{id}', name: 'app_productItem')]
    public function showProductItem(Product $product): Response
    {
        return $this->render('pantry/productItemInfo.html.twig',
            ['product' => $product],
        );
    }
}