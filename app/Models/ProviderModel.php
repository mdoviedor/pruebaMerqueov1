<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProviderModel extends Model
{

    protected $table = 'providers';
    protected $fillable = ['id', 'name'];
    public $timestamps = false;

    public function loadProviders(array $data)
    {



    }

    public function newLoad(array $providers)
    {

        $providers = current($providers);
        $providersSave = array();// Arreglo para cargue de nuevos proveedores
        $idsProvidersDelete = array();//Identificadores de proveedores a eliminar
        $providersFtProducts = array();// Arreglo proveedores con productos

        foreach ($providers as $provider) {

            $idProvider = $provider['id'];
            $nameProvider = $provider['name'];

            $idsProvidersDelete[] = $idProvider;

            $providersSave[] = [
                'id' => $idProvider,
                'name' => $nameProvider
            ];

            foreach ($provider['products'] as $product) {
                $providersFtProducts[$idProvider][] = $product['productId'];
            }

        }

        $this->whereIn('id', $idsProvidersDelete)->delete();

        if($this->insert($providersSave) != true)
            throw new \Exception('No se crearon los proveedores!', 500);

        return $providersFtProducts;
    }

}
