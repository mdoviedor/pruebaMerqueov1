<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'user',
        'address',
        'deliveryDate',
        'priority'
    ];
    public $timestamps = false;


    public function loadOrders(array $data)
    {
        $modelRelOrderProduct = new RelOrdersProductsModel();
        $registersSave = array();
        $relOrderProducts = array();
        $idsOrderDelete = array();

        foreach ($data as $order) {

            $id = $order['id'];
            $user = $order['user'];
            $address = $order['address'];
            $deliveryDate = $order['deliveryDate'];
            $priority = $order['priority'];
            $products = $order['products'];

            $idsOrderDelete[] = $id;

            $registersSave[] = [
                'id' => $id,
                'user' => $user,
                'deliveryDate' => $deliveryDate,
                'address' => $address,
                'priority' => $priority
            ];

            $relOrderProducts[$id] = $products;

        }

        // Eliminación de ordenes
        $this->whereIn('id', $idsOrderDelete)->delete();

        // Cargue de ordenes
        if (! $this->insert($registersSave))
            throw new \Exception('Error en el cargue de la orden!');

        return $modelRelOrderProduct->loadProductsOfOrder($relOrderProducts);
    }


    public function getAllOrders()
    {

        $columns = [
            'orders.id AS idOrder',
            'orders.user',
            'orders.address',
            'orders.deliveryDate',
            'orders.priority',
            'relOrdersProducts.id AS idProduct',
            'relOrdersProducts.idProduct',
            'relOrdersProducts.nameProduct',
            'relOrdersProducts.quantity'
        ];

        return
            $this
                ->select($columns)
                ->join('relOrdersProducts', 'orders.id', '=', 'relOrdersProducts.idOrder')
                ->orderBy('orders.priority', 'ASC');

    }

}
