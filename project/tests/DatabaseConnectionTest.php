<?php
namespace Tests;

use App\Core\Database;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testDatabaseConnection()
    {
        $object = new \App\Core\Database;
        $this->assertSame('project2',env('DB_NAME'));
//        $this->assertSame('Database2`12`12', get_class($object ));
//        $this->assertInstanceOf(\PDO::class,\App\Core\Database::getConnection());
    }

}