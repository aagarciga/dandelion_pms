<?php


namespace App\Tests;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class PersistenceTest extends KernelTestCase
{
    /** @var EntityManager */
    protected $entityManager;
    /** @var \Doctrine\DBAL\Connection */
    protected $connection;
    protected $dbPlatform;

    abstract function testIntegration();

    protected function setUp()
    {
        parent::setUp();

        // Alex: to get an entityManager reference
        self::bootKernel();
        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
        $this->connection = $this->entityManager->getConnection();
        try {
            $this->dbPlatform = $this->connection->getDatabasePlatform();
        } catch (DBALException $e) {
            // TODO: Handle error
            throw $e;
        }
        // Alex: Example of how to set the User entity table empty
//        $this->truncateEntities([
//            User::class,
//        ])
    }

    /**
     * Activates or deactivates database foreign key check
     * @param bool $active
     * @return bool
     * @throws DBALException
     */
    protected function setDBReferenceCheck($active = true): bool
    {
        $value = $active?1:0;
        if ($this->dbPlatform->supportsForeignKeyConstraints()){
            try {
                $this->connection->query("SET FOREIGN_KEY_CHECKS=$value");
                return true;
            } catch (DBALException $e) {
                // TODO: Handle error
                throw $e;
            }
        }
        return false;
    }

    /**
     * This will empty the array of entities
     * @param array $entities
     * @return bool
     * @throws DBALException
     */
    protected function truncateEntities(array $entities): bool
    {
        if($this->setDBReferenceCheck(false)){
            foreach ($entities as $entity) {
                $query = $this->dbPlatform->getTruncateTableSQL(
                    $this->entityManager->getClassMetadata($entity)->getTableName()
                );
                try {
                    $this->connection->executeUpdate($query);
                    $this->setDBReferenceCheck(true);
                    return true;
                } catch (DBALException $e) {
                    // TODO: Handle error
                    throw $e;
                }
            }
        }
        return false;
    }


}