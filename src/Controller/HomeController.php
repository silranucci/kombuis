<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductItemRepository;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(ProductItemRepository $productItemRepository, ProductRepository $productRepository): Response
    {
        $expiringProducts = $productItemRepository->findFirstTenProductItemsExpiringWithinFifteenDays();
        $productUnderSafetyStock = $productRepository->findProductUnderSafetyStock();

        return $this->render('homepage/homepage.html.twig', [
            'expiringProducts' => $expiringProducts,
            'productUnderSafetyStock' => $productUnderSafetyStock,
        ]);
    }

    #[Route('/pantry/expiring-products', name: 'app_expiring_product')]
    public function showAllExpiringProduct(ProductItemRepository $productItemRepository)
    {
        $expiringProducts = $productItemRepository->findAllProductItemsExpiringWithinFifteenDays();

        return $this->render('homepage/expiring_product_list.html.twig', [
            'expiringProducts' => $expiringProducts,
        ]);
    }

    #[Route('/pantry/product-under-safety-stock', name: 'app_product_under_safety_stock')]
    public function showAllProductUnderSafetyStock(ProductRepository $productRepository)
    {
        $productUnderSafetyStock = $productRepository->findProductUnderSafetyStock();

        return $this->render('_product_under_safety_stock.html.twig', [
            'expiringProducts' => $productUnderSafetyStock,
        ]);
    }
}