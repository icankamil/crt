<?php
require_once __DIR__ . "/config/bootstrap.php";
require_once __DIR__ . "/Model/Product.php";

$productRepository = $entityManager->getRepository('Product');
$products = $productRepository->findAll();

foreach ($products as $product) {
    echo sprintf("-%s\n", $product->getName());
}
