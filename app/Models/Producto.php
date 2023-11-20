<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
 use HasFactory;
 protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'categoria_id'];
 public function categoria()
 {
 return $this->belongsTo(Categoria::class); // Un producto pertenece a una categoria
 }
 public function pedidos()
{
return $this->belongsToMany(Pedido::class)->withPivot('cantidad', 'precio'); // Un producto puede estar en varios pedidos
}
    // ... otros atributos y métodos del modelo

    // Método para obtener la URL de la imagen
    public function imagenUrl()
    {
        if ($this->imagen) {
            // Asumiendo que el nombre de la columna de imagen es 'imagen'
            // y que las imágenes se almacenan en una carpeta 'images'
            return asset('images/' . $this->imagen);
        } else {
            // Si no hay imagen, puedes devolver una imagen por defecto
            return asset('images/default.jpg');
        }
    }
}
