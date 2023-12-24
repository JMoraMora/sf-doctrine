<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use App\Entity\Tag;
use App\Entity\Comment;

use Doctrine\ORM\EntityManagerInterface;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        return $this->render('page/home.html.twig', [
            'products' => $em->getRepository(Product::class)->findLatest(),
        ]);
    }

    #[Route('/tag/{id}', name: 'app_tag')]
    public function tag(Tag $tag, EntityManagerInterface $em): Response
    {
        return $this->render('page/tag.html.twig', [
            'tag' => $tag,
            'products' => $em->getRepository(Product::class)->findByTags($tag),
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function product(Product $product): Response
    {
        return $this->render('page/product.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/comments', name: 'app_comments')]
    public function comments(EntityManagerInterface $em): Response
    {
        return $this->render('page/comments.html.twig', [
            'comments' => $em->getRepository(Comment::class)->findAllComments(),
        ]);
    }

}
