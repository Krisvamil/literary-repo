<?php
namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\AuthController;

class AuthControllerTest extends TestCase
{
    public function testCanInstantiateController(): void
    {
        $this->assertInstanceOf(AuthController::class, new AuthController());
    }
}