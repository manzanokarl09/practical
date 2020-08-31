<?php

namespace App\Http\Controllers\V1;
use App\Repositories\Rest\RestRepository;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends BaseController {

    /**
     * @var RestRepository
     */
    private $rest;

    public function __construct(Order $rest, Product $product) {

        $this->rest = new RestRepository($rest);
        $this->product = $product;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $data = $request->all();
      
        $product = $this->deduct_quantity($data);
        if($product['status'] == true){

            $response = $this->rest->create($data);
            return response()->json(['message' => 'You have successfully ordered this product.'], 201);
        }

        return response()->json(['message' => 'Failed to order this product due to unavailability of the stock.'], 400);
    }

    public static function deduct_quantity($data){

        $product = Product::find($data['product_id']);
        if($product->available_stock >= $data['quantity']){
            $product->available_stock = $product->available_stock - $data['quantity'];
            $product->save();
            $response = [
                'status' => true
            ];
            return $response;
        }
        $response = [
            'status' => false
        ];
        return $response;
        
    }

}
