<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelOrdersProductsModel extends Model
{
    protected $table = 'relOrdersProducts';
    protected $fillable = ['id', 'idOrder', 'idProduct', 'nameProduct', 'quantity'];

    public function loadProductsOfOrder(array $data)
    {
        
        $registerSave = array();

        foreach ($data as $idOrder => $products)
        {

            foreach ($products as $product) {
                $registerSave[] = [
                    'idOrder' => $idOrder,
                    'idProduct' => $product['id'],
                    'nameProduct' => $product['name'],
                    'quantity' => $product['quantity']
                ];
            }

        }

        return $this->insert($registerSave);
        
    }


}
