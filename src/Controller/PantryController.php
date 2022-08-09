<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PantryController extends AbstractController
{

    #[Route('/')]
    public function pantry()
    {
        return $this->render('pantry/pantryGrid.html.twig');
    }
}