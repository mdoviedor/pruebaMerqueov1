<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

/**
 * @SWG\Swagger(
 *     basePath="/api/v1",
 *     schemes={"http", "https"},
 *     host=L5_SWAGGER_CONST_HOST,
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="API .:: MERQUEO ::. ",
 *         description="Descripción de recursos disponibles en el API",
 *         @SWG\Contact(
 *             email="jesus950810@gmail.com"
 *         ),
 *     )
 * )
 */
class ProductsController extends Controller
{

    /**
     * @SWG\Post(
     *     path="/product/load",
     *     summary="Cargar productos al inventario",
     *     tags={"1. Products"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="Generar cargue correcto de los productos."
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function load(Request $request)
    {

        $archivoBase = json_decode(Storage::disk('local')->get('recursos\inventory-merqueo.json'), true);
        $model = new ProductModel();

        try{

            if($model->newLoad($archivoBase))
                return response()->json(['statusProcess' => 'Cargue correcto!']);

            return response()->json(['statusProcess' => 'Cargue no realizado!']);

        }catch (Exception $e){
            return response(null, 500)->json(['statusProcess' => $e->getMessage()]);
        }

    }

    /**
     * @SWG\Get(
     *     path="/product/all",
     *     summary="Mostrar listado completo de productos en el inventario",
     *     tags={"1. Products"},
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
        $data = (new ProductModel())->get(['id', 'name', 'stock', 'description'])->toArray();
        return response()->json($data);
    }

    /**
     * @SWG\Get(
     *     path="/product/{id}",
     *     summary="Mostrar datos de un producto especifico",
     *     tags={"1. Products"},
     *     operationId="find",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="identificador del producto",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successfull"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     *
     */
    public function find($idProduct)
    {

        $idProduct = (int) $idProduct;
        $data = (new ProductModel())->find($idProduct);
        return response()->json($data);

    }

}
