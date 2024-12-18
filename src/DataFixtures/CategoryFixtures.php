<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
  public const CATEGORIES = [
    'Fille',
    'Garçon',
    'Mixte',
  ];

  public function load(ObjectManager $manager)
  {
    foreach (self::CATEGORIES as $categoryName) {
      $category = new Category();
      $category->setName($categoryName);
      $category->setDescription("Description pour la catégorie $categoryName");

      $manager->persist($category);
    }

    $manager->flush();
  }
}
