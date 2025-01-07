<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
  private UserPasswordHasherInterface $passwordHasher;

  public function __construct(UserPasswordHasherInterface $passwordHasher)
  {
    $this->passwordHasher = $passwordHasher;
  }

  public function load(ObjectManager $manager): void
  {
    $user = new User();
    $user->setEmail('admin@example.com');
    $user->setRoles(['ROLE_USER']);
    $user->setPassword(
      $this->passwordHasher->hashPassword($user, 'password123')
    );

    $manager->persist($user);
    $manager->flush();
  }
}