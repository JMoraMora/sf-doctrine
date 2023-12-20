<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        return $this->render('page/home.html.twig', [
            'products' => $em->getRepository(Product::class)->findAll(),
        ]);
    }

    #[Route('/tag/{id}', name: 'app_tag')]
    public function tag(Tag $tag): Response
    {
        return $this->render('page/tag.html.twig', [
            'tag' => $tag,
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function product(Product $product): Response
    {
        return $this->render('page/product.html.twig', [
            'product' => $product,
        ]);
    }
}
