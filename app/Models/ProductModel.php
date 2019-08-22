<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'description', 'stock', 'date'];


    public function newLoad(array $data)
    {

        $dataSave = array();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        $data = current($data);

        foreach ($data as $datum) {

            $dataSave = [
                'id' => $datum['id'],
                'name' => 'Producto ' . $datum['id'],
                'description' => 'Cargue de producto ' . $datum['id'] . ' '. date('Y-m-d H:i:s'),
                'stock' => $datum['quantity'],
                'date' => $datum['date']
            ];

            $this->create($dataSave);
        }

        return true;
    }

    public function getProductsFromInventary()
    {
        $columns = [
          't1.idProduct',
          't1.nameProduct',
          't2.stock AS stockOfProductFromInventary'
        ];

        $this->table = 'products AS t2';

        return

        $this
            ->select($columns)
            ->leftJoin('relOrdersProducts AS t1', 't1.idProduct', '=', 't2.id');
    }

    /**
     * Sentencia Base
     *
     * @param array $columns
     * @return OrdersModel
     */
    private function getQueryWithOrder(array $columns)
    {

        $modelOrder = new OrdersModel();
        $modelOrder->setTable('orders AS t0');

        return
            $modelOrder
                ->select($columns)
                ->join('relOrdersProducts AS t1', 't0.id','=', 't1.idOrder')
                ->join('products AS t2', 't1.idProduct', '=', 't2.id');
    }

    /**
     * Productos menos vendidos
     */
    public function getLessSoldProducts()
    {


        $columns = [
            't1.idProduct',
            DB::raw('GROUP_CONCAT(DISTINCT t1.nameProduct) AS nameProduct'),
            DB::raw('SUM(t1.quantity) AS quantitySold')
        ];

        $modelOrder = $this->getQueryWithOrder($columns);

        return
            $modelOrder
                ->where('t0.deliveryDate', '=', '2019-03-01')
                ->groupBy('t1.idProduct')
                ->orderBy('quantitySold', 'ASC');

    }

    /**
     * Productos mas vendidos
     */
    public function getMostSolledProducts()
    {

        $columns = [
            't1.idProduct',
            DB::raw('GROUP_CONCAT(DISTINCT t1.nameProduct) AS nameProduct'),
            DB::raw('SUM(t1.quantity) AS quantitySold')
        ];

        $modelOrder = $this->getQueryWithOrder($columns);

        return
            $modelOrder
                ->where('t0.deliveryDate', '=', '2019-03-01')
                ->groupBy('t1.idProduct')
                ->orderBy('quantitySold', 'DESC');

    }

    /**
     * Productos que deben ser abastecidos por proveedor
     * @param integer $idOrder
     * @return OrdersModel
     */
    public function getProductsSupplyByProvider($idOrder = null)
    {
        $columns = [
            't1.idProduct',
            DB::raw('GROUP_CONCAT( DISTINCT t1.nameProduct) AS nameProduct'),
            DB::raw('SUM(t1.quantity) AS quantitySold'),
            't2.stock AS stockInventary',
            DB::raw('IF(SUM(t1.quantity) > t2.stock, \'YES\', \'NOT\') AS SupplyByProvider')
        ];

        $modelOrder = $this->getQueryWithOrder($columns);


        if (! is_null($idOrder))
            $modelOrder = $modelOrder->where('t0.id', '=', (int) $idOrder);

        return
            $modelOrder
                ->groupBy('t1.idProduct')
                ->orderBy('t1.idProduct');

    }

    /**
     * Stock de inventario después de las ventas realizadas el 01 de marzo
     */
    public function getInventaryAfterSoly()
    {

        $columns = [
            't1.idProduct',
            DB::raw('GROUP_CONCAT( DISTINCT t1.nameProduct) AS nameProduct'),
            DB::raw('(IF((t2.stock - SUM(t1.quantity)) <= 0, 0,  t2.stock - SUM(t1.quantity))) AS UnitsAvailable')
        ];

        $modelOrder = $this->getQueryWithOrder($columns);

        return
            $modelOrder
                ->groupBy('t1.idProduct')
                ->where('t0.deliveryDate', '=', '2019-03-01')
                ->orderBy('t1.idProduct');

    }
    
    
}
