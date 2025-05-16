<?php
namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Work;
use App\Models\Model;
use PDO;

class WorkTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Model::setConnection($pdo);

        $pdo->exec('CREATE TABLE works (id INTEGER PRIMARY KEY, title TEXT, content TEXT, author_id INTEGER, created_at TEXT)');
    }

    public function testCreateWork(): void
    {
        $result = Work::create([
            'title' => 'Unit Test Work',
            'content' => 'Lorem ipsum',
            'author_id' => 1
        ]);

        $this->assertTrue($result);
        $works = Work::all();
        $this->assertCount(1, $works);
        $this->assertSame('Unit Test Work', $works[0]['title']);
    }
}
