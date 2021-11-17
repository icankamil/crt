<?php
// create_user.php
require_once __DIR__ . "/config/bootstrap.php";
require_once __DIR__ . "/Model/Bug.php";
require_once __DIR__ . "/Model/User.php";
require_once __DIR__ . "/Model/Product.php";

$newUsername = $argv[1];

$user = new User();
$user->setName($newUsername);

$entityManager->persist($user);
$entityManager->flush();

echo "Created User with ID " . $user->getId() . "\n";
