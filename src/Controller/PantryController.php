<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductItem;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PantryController extends AbstractController
{
    #[Route('/pantry', name: 'app_pantry_homepage')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findBy([], ['name' => 'ASC']);

        return $this->render('pantry/pantryGrid.html.twig',
            ['products' => $products]
        );
    }

    #[Route('/pantry/new', name: 'app_pantry_new_product')]
    public function newProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $productItem = new ProductItem();
            $productItem->setOpeningDate($data['openingDate'])
                ->setQuantity($data['quantity'])
                ->setUseByDate($data['useByDate']);

            $product = new Product();
            $product->setName($data['name'])
                ->setBrand($data['brand']);
            $product->setDaysIsGoodAfterOpening($data['daysIsGoodAfterOpening']);
            $product->setSafetyStock($data['safetyStock']);
            $product->setUnitOfMeasure($data['unitOfMeasure']);
            $product->addProductItem($productItem);

            $entityManager->persist($product);
            $entityManager->flush();
        }

        return $this->render('pantry/product_new.html.twig', [
            'productForm' => $form->createView(),
        ]);
    }

    #[Route('/pantry/{id}', name: 'app_productItem')]
    public function showProductItem(Product $product): Response
    {
        return $this->render('pantry/productItemInfo.html.twig',
            ['product' => $product],
        );
    }
}