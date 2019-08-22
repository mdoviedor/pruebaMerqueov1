<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/report/A",
     *     summary="Productos y qué cantidad puede ser alistada desde inventario",
     *     tags={"4. Reports"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="1er Informe solicitado"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function reportA(Request $request)
    {
        $modelProducts = new ProductModel();
        $data = $modelProducts->getProductsFromInventary()->get()->toArray();
        return response()->json($data);

    }

    /**
     * @SWG\Get(
     *     path="/report/B",
     *     summary="Productos que deben ser alistados por transportadores, y a qué transportador le corresponde cada pedido",
     *     tags={"4. Reports"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="2do Informe solicitado"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function reportB(Request $request)
    {
        return response()->json(['data' => 'No se definen transportadores en el planteamiento del problema!']);

    }

    /**
     * @SWG\Get(
     *     path="/report/C",
     *     summary="Productos menos vendidos el día 1 de marzo",
     *     tags={"4. Reports"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="2do Informe solicitado"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function reportC(Request $request)
    {
        $modelProducts = new ProductModel();
        $data = $modelProducts->getLessSoldProducts()->get()->toArray();
        return response()->json($data);
    }

    /**
     * @SWG\Get(
     *     path="/report/D",
     *     summary="Dado el Id de un pedido, ver que producos y que cantidad pueden ser alistados segun inventario y cuales abastecidos por proveedores",
     *     tags={"4. Reports"},
     *
     *     @SWG\Parameter(
     *        name="idOrden",
     *        in="query",
     *        description="Identificador de la orden",
     *        required=false,
     *        type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="2do Informe solicitado"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function reportD(Request $request)
    {
        $model = new ProductModel();
        $idOrder = $request->get('idOrden');

        $data = $model->getProductsSupplyByProvider($idOrder)->get()->toArray();
        return response()->json($data);

    }

    /**
     * @SWG\Get(
     *     path="/report/E",
     *     summary="Calcular el inventario del día 2 de marzo, teniendo en cuenta los pedidos despachados el 1 de marzo",
     *     tags={"4. Reports"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="2do Informe solicitado"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function reportE(Request $request)
    {
        $model = new ProductModel();

        $data = $model->getInventaryAfterSoly()->get()->toArray();
        return response()->json($data);

    }

    /**
     * @SWG\Get(
     *     path="/report/F",
     *     summary="Productos más vendidos el día 1 de marzo",
     *     tags={"4. Reports"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="2do Informe solicitado"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function reportF(Request $request)
    {

        $modelProducts = new ProductModel();
        $data = $modelProducts->getMostSolledProducts()->get()->toArray();
        return response()->json($data);

    }

}
