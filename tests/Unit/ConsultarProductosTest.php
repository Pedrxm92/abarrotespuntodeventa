<?php
namespace Tests\Unit;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class ConsultarProductosTest extends TestCase
{
//Test para obtener todos los productos
public function test_obtener_todos_los_productos(): void
{
$response = $this->get('/api/v1/productos');
$response->assertStatus(200);
}
}