<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductItem;
use App\Form\AddProductFormType;
use App\Form\ProductItemType;
use App\Form\ProductType;
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

        return $this->render('/pantry/product_list.html.twig',
            ['products' => $products]
        );
    }

    // TODO - https://blog.martinhujer.cz/symfony-forms-with-request-objects/
    #[Route('/pantry/new', name: 'app_pantry_new_product')]
    public function addNewProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AddProductFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            /** @var Product $product */
            $product = $data['product'];
            $product->addProductItem($data['productItem']);

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_pantry_homepage');
        }

        return $this->render('pantry/product_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pantry/edit-product/{id}', name: 'app_edit_product')]
    public function editProduct(Product $product, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_pantry_homepage', [
            ]);
        }

        return $this->render('pantry/product_edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);

    }


    #[Route('/pantry/edit-item/{id}', name: 'app_edit_product_item')]
    public function editProductItem(ProductItem $productItem, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ProductItemType::class, $productItem);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($productItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_pantry_homepage');
            //return $this->redirectToRoute('app_productItem', ['id' => $productItem->getId()]);
        }

        return $this->render('pantry/product_item_edit.html.twig', [
            'productItem' => $productItem,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/pantry/{id}', name: 'app_productItem')]
    public function showProductItem(Product $product): Response
    {
        return $this->render('pantry/product_item_info.html.twig',
            ['product' => $product],
        );
    }
}