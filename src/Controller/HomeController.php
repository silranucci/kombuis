<?php

namespace App\Controller;

use App\Repository\ProductItemRepository;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(ProductItemRepository $productItemRepository): Response
    {
        $expiringProducts = $productItemRepository->findFirstTenProductItemsExpiringWithinFifteenDays();

        return $this->render('homepage/homepage.html.twig', [
            'productItems' => $expiringProducts,
        ]);
    }

    #[Route('/pantry/expiring-products', name: 'app_expiring_product')]
    public function showAllExpiringProduct(ProductItemRepository $productItemRepository)
    {
        $expiringProducts = $productItemRepository->findAllProductItemsExpiringWithinFifteenDays();

        return $this->render('homepage/expiring_product.html.twig', [
            'expiringProducts' => $expiringProducts,
        ]);
    }
}