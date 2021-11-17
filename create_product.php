<?php
// create_product.php <name>
require_once __DIR__ . "/config/bootstrap.php";
require_once __DIR__ . "/Model/Product.php";

$newProductName = $argv[1];

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";
