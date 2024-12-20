<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;

#[Route('/product', name: 'product_')]
class ProductController extends AbstractController
{
  // Méthode pour afficher la liste des produits
  #[Route('/', name: 'index')]
  public function index(ManagerRegistry $doctrine): Response
  {
    // Récupération de tous les produits depuis la base de données
    $products = $doctrine->getRepository(Product::class)->findAll();

    // Rendu du template avec la liste des produits
    return $this->render('product/index.html.twig', [
      'products' => $products,
    ]);
  }

  // Méthode pour afficher les détails d'un produit spécifique
  #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
  public function show(ManagerRegistry $doctrine, int $id): Response
  {
    // Recherche du produit par son ID
    $product = $doctrine->getRepository(Product::class)->find($id);

    // Gestion du cas où le produit n'est pas trouvé
    if (!$product) {
      throw $this->createNotFoundException('Produit introuvable.');
    }

    // Rendu du template avec les détails du produit
    return $this->render('product/show.html.twig', [
      'product' => $product,
    ]);
  }
}
