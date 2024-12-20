<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Enum\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
  public const PRODUCTS = [
    [
      'name' => 'Robe Fleurie',
      'gender' => Gender::GIRL,
      'price' => 29.99,
      'size' => 4,
      'description' => 'Une robe légère et élégante pour les filles.',
      'isSold' => false,
      'createDate' => '2023-01-15',
      'category' => 'category_Fille',
    ],
    [
      'name' => 'Pantalon en Denim',
      'gender' => Gender::BOY,
      'price' => 34.99,
      'size' => 8,
      'description' => 'Un pantalon résistant et stylé pour les garçons.',
      'isSold' => true,
      'createDate' => '2023-02-10',
      'category' => 'category_Garçon',
    ],
    [
      'name' => 'T-shirt Unisexe',
      'gender' => Gender::UNISEXE,
      'price' => 19.99,
      'size' => 9,
      'description' => 'Un T-shirt confortable pour tout le monde.',
      'isSold' => false,
      'createDate' => '2023-03-01',
      'category' => 'category_Mixte',
    ],
  ];

  public function load(ObjectManager $manager)
  {
    foreach (self::PRODUCTS as $productData) {
      $product = new Product();
      $product->setName($productData['name']);
      $product->setGender($productData['gender']);
      $product->setPrice($productData['price']);
      $product->setSize($productData['size']);
      $product->setDescription($productData['description']);
      $product->setSold($productData['isSold']);
      $product->setCreateDate(new \DateTime($productData['createDate']));

      $categoryReference = $productData['category'];
      if (!$this->hasReference($categoryReference)) {
        throw new \RuntimeException("La référence '{$categoryReference}' n'a pas été trouvée. Vérifiez vos CategoryFixtures.");
      }

      $product->setCategory($this->getReference($categoryReference));


      $manager->persist($product);
    }

    $manager->flush();
  }

  public function getDependencies(): array
  {
    return [
      CategoryFixtures::class,
    ];
  }
}
