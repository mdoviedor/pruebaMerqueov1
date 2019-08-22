<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelProviderProductsModel extends Model
{
    protected $table = 'relProviderProducts';
    protected $fillable = ['idProvider', 'idProduct', 'backUpStock'];
    public $timestamps = false;


    /**
     * Cargue de productos disponibles por cada proveedor
     *
     * @param array $data
     * @return bool
     */
    public function loadProductsByProvider(array $data)
    {

        foreach ($data as $idProvider => $products) {

            $modelProduct = new ProductModel();
            $modelProductOutOfInventory = new ProductOutOfInventoryModel();

            $providerFtProduct = array();

            // Busqueda de productos en base
            $productsBD =
                $modelProduct
                    ->select('id AS idProduct')
                    ->whereIn('id', $products)
                    ->get()->toArray();

            // Armado de arreglo para cada registro relacion proveedor / producto
            foreach ($productsBD as $product) {

                $providerFtProduct[] = [
                    'idProvider' => $idProvider,
                    'idProduct' => $product['idProduct'],
                    'backUpStock' => 1
                ];

                $idProductDB = $product['idProduct'];

                array_walk($products, function($idProduct, $key) use($idProductDB, &$products){

                    // Si el registro que llega por parametro está en la entidad products se elimina de
                    // la variable $products
                    if ($idProductDB == $idProduct)
                        unset($products[$key]);

                });

            }

            // Almacenamiento de productos que no estan en el inventario
            $modelProductOutOfInventory->loadProducts($products, $idProvider);
            $this->insert($providerFtProduct);

        }    

        return true;
    }

}
