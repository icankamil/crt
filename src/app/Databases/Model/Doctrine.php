<?php

namespace App\Databases\Model;

use src\core\GlobalFunc;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class Doctrine
{
    protected $isDevMode;
    protected $proxyDir;
    protected $cache;
    protected $useSimpleAnnotationReader;
    protected $config;
    protected $conn;
    protected $entityManager;

    public function __construct()
    {
        $this->isDevMode = true;
        $this->proxyDir = null;
        $this->cache = null;
        $this->useSimpleAnnotationReader = false;
        $this->config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $this->isDevMode, $this->proxyDir, $this->cache, $this->useSimpleAnnotationReader);
        // or if you prefer yaml or XML
        // $config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
        // $config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

        // database configuration parameters
        $this->conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite',
        );
        // Create a simple "default" Doctrine ORM configuration for Annotations


        // obtaining the entity manager
        $this->entityManager = EntityManager::create($this->conn, $this->config);
    }
}
