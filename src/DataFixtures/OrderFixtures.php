<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
  public const ORDERS = [
    [
      'dateOfPurchase' => '2023-05-10',
      'comment' => 'Commande passée lors de la promotion de printemps.',
      'createDate' => '2023-05-01',
    ],
    [
      'dateOfPurchase' => '2023-06-15',
      'comment' => 'Commande avec un code promo spécial.',
      'createDate' => '2023-06-10',
    ],
    [
      'dateOfPurchase' => '2023-07-20',
      'comment' => 'Commande urgente pour un anniversaire.',
      'createDate' => '2023-07-15',
    ],
  ];

  public function load(ObjectManager $manager)
  {
    foreach (self::ORDERS as $orderData) {
      $order = new Order();
      $order->setDateOfPurchase(new \DateTime($orderData['dateOfPurchase']));
      $order->setComment($orderData['comment']);
      $order->setCreateDate(new \DateTime($orderData['createDate']));

      $manager->persist($order);
    }

    $manager->flush();
  }
}
