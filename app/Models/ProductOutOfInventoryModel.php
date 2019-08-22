<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOutOfInventoryModel extends Model
{
    protected $table = 'productsOutOfInventory';
    protected $fillable = ['id', 'name', 'description', 'stock', 'idProvider'];
    public $timestamps = false;


    public function loadProducts(array $data, $idProvider)
    {

        if (empty($data))
            return true;

        $dataLoad = array();

        foreach ($data as $idProduct) {
            $dataLoad[] = [
                'id' => $idProduct,
                'name' => 'Producto ' . $idProduct,
                'description' => 'Cargue de producto ' . $idProduct. ' '. date('Y-m-d H:i:s'),
                'stock' => 1,
                'idProvider' => $idProvider
            ];
        }

        return $this->insert($dataLoad);

    }

}
