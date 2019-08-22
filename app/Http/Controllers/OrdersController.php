<?php

namespace App\Http\Controllers;

use App\Models\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{


    /**
     * @SWG\Post(
     *     path="/order/load",
     *     summary="Cargar pedidos al sistema",
     *     tags={"3. Orders"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="Generar cargue correcto de pedidos."
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function load(Request $request)
    {

        $archivoBase = json_decode(Storage::disk('local')->get('recursos\orders-merqueo.json'), true);
        $data = $archivoBase['orders'];
        $modelOrders = new OrdersModel();


        try{
            $modelOrders->loadOrders($data);

            if ($modelOrders)
                return response()->json(['statusProcess' => 'Cargue correcto!']);

            return response()->json(['statusProcess' => 'Cargue no realizado!']);


        }catch (\Exception $e){
            abort(500, $e->getMessage() . '/' . $e->getFile() . '/'. $e->getLine());
        }

    }

    /**
     * @SWG\Get(
     *     path="/order/all",
     *     tags={"3. Orders"},
     *     summary="Mostrar listado completo de productos",
     *     @SWG\Response(
     *         response=200,
     *         description="Mostrar todos los productos."
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function all()
    {
        $data = (new OrdersModel())->getAllOrders()->get()->toArray();
        return response()->json($data);
    }




}
