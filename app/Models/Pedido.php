<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pedido extends Model
{
use HasFactory;
protected $fillable = ['fecha', 'estado', 'user_id'];
public function user()
{
return $this->belongsTo(User::class); // Un pedido pertenece a un usuario
}
public function productos()
{
return $this->belongsToMany(Producto::class)->withPivot('cantidad', 'precio'); // Un pedido puede tener varios productos
}
}