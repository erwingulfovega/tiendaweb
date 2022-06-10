<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrdersDetails;
use DB;
use Carbon\Carbon;


class OrdersController extends Controller
{
    
    public function index(Request $request){
        $vista="orders";
        return view('home.index')->with("vista",$vista);  
    }

        public function store(Request $request)
    {
        
        $messages = [
           'nombres.required'  => 'Nombres del cliente son obligatorios es requerido',
           'email.required'    => 'Email es requerido',
           'celular.required'  => 'Número de celular es requerido',
           'detalles.required' => 'La orden no tiene artículos',
         
         ];
    
        $validator = Validator::make($request->all(), [
            'nombres'         => 'required',
            'email'           => 'required',
            'celular'         => 'required',
            'detalles'        => 'required',
        ],$messages);

        if ($validator->fails()) {
            return view('orders.store')
                        ->withErrors($validator)
                        ->with("guardar",false);
        }
      
       \DB::beginTransaction();
        
       try{
                        
            $orders = new Orders;
           
            $orders->custome_name  = $request->input('nombres');
            $orders->custome_email = $request->input('email');
            $orders->custome_mobile= $request->input('celular');
            $orders->status        = 'CREATED';
            $orders->valor         = $request->input('valor_input_orden');
           
            if(!$orders->save()){
                \DB::rollback();
               
                return view('orders.store')
                        ->with("guardar",false)
                        ->with("mensaje","Error al guardar la orden");

                  
            }
               
            $detalles_item = str_replace("]\"","]",str_replace("\"[","[",str_replace("\\","",$request->input('detalles'))));
    
            if($detalles_item!=''){   
                if(json_decode($detalles_item)){
                    $detalles_item = json_decode($detalles_item);

                      foreach( $detalles_item as $items):
                        if($items->codigo!=''){
                            $detalles = new OrdersDetails();   
                            $detalles->order_id    = $orders->id;
                            $detalles->articulo_id = $items->id;
                            $detalles->cantidad    = $items->cantidad;
                            $detalles->subtotal    = $items->subtotal;
                            $detalles->valor       = $items->valor;              

                            if(!$detalles->save()){
                                \DB::rollback();
                                return view('orders.store')
                                        ->with("guardar",false)
                                        ->with("mensaje","Error al adicionar los artíclos a la orden");
                            }
                       }
                    endforeach;

                }else{
                    \DB::rollback();
                    return view('orders.store')
                                ->with("guardar",false)
                                ->with("mensaje","Error al adicionar los artíclos a la orden");
        }
                
            }
          
        \DB::commit();

        return view("orders.store")->with("guardar",true)
                                   ->with("mensaje","Orden guardada")
                                   ->with("order_id",$orders->id);
                        
        }catch(ValidationException $e)
        {
            \DB::rollback();
            return view('orders.store')
                    ->with("guardar",false)
                    ->with("mensaje","Error al adicionar los artíclos a la orden");
        } catch(\Exception $e)
        {
            \DB::rollback();
            throw $e;
        }    
    }

    public function show($id){
        
        $orders = Orders::find($id);

        $details = DB::table('orders_details as od')
                    ->join('articles as a', 'od.articulo_id', '=', 'a.id')
                    ->where('od.order_id',$orders->id)
                    ->select('od.*','a.codigo','a.descripcion')
                    ->get();

        return view('orders.show', compact('orders','details','id'));
    }
    
    function listOrders(){

        $orders = Orders::get();
        $vista ="lista";

        return view('orders.lista', compact('orders','vista'));
    }


    public function thankey($id){

        $curl = curl_init();
        date_default_timezone_set('America/Bogota');
        $login = env('LOGIN');
        $secretKey  = env('SECRETKEY');
        $nonce = random_bytes(16);
        $seed = date('c');
        $digest = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
        $nonce = base64_encode($nonce);
        $new_seed = date('c' ,strtotime("+ 1 days"));
        $url_return=url('orders/getSession/').'/'.$id;
    
        $orders = Orders::find($id);

        $datos = '{
          "locale": "es_CO",
          "auth": {
            "login": "'.$login.'",
            "tranKey": "'.$digest.'",
            "nonce": "'.$nonce.'",
            "seed": "'.$seed.'"
          },
          "payment": {
            "reference": "'.$orders->id.'",
            "description": "'.'Orden: '.$orders->id.'",
            "amount": {
              "currency": "COP",
              "total": "'.$orders->valor.'"
            },
            "allowPartial": false
          },
          "expiration": "'.$new_seed.'",
          "returnUrl": "'.$url_return.'",
          "ipAddress": "127.0.0.1",
          "userAgent": "PlacetoPay Sandbox"
          }';
          //echo "<pre> datos: ".$datos."</pre>";
        //https://checkout-test.placetopay.com/api/session

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://dev.placetopay.com/redirection/api/session',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$datos,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $json_response = json_decode($response, true);
        $json_response["requestId"];

        $order= Orders::find($id);
        $order->requestId = $json_response["requestId"];
        $order->save();

        return json_decode($response);

    }

    public function getSession($id){

        $curl = curl_init();
        date_default_timezone_set('America/Bogota');
        $login = env('LOGIN');
        $secretKey  = env('SECRETKEY');
        $nonce = random_bytes(16);
        $seed = date('c');
        $digest = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
        $nonce = base64_encode($nonce);
        $new_seed = date('c' ,strtotime("+ 1 days"));
        $url_return=url('orders/getSession/').'/'.$id;
        $orders = Orders::find($id);

        $datos = '{
          "locale": "es_CO",
          "auth": {
            "login": "'.$login.'",
            "tranKey": "'.$digest.'",
            "nonce": "'.$nonce.'",
            "seed": "'.$seed.'"
          },
          "payment": {
            "reference": "'.$orders->id.'",
            "description": "'.'Orden: '.$orders->id.'",
            "amount": {
              "currency": "COP",
              "total": "'.$orders->valor.'"
            },
            "allowPartial": false
          },
          "expiration": "'.$new_seed.'",
          "returnUrl": "'.$url_return.'",
          "ipAddress": "127.0.0.1",
          "userAgent": "PlacetoPay Sandbox"
          }';

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://dev.placetopay.com/redirection/api/session/56302',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$datos,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
 
        $json_response = json_decode($response, true);

        $order= Orders::find($id);

        $estado="";
        
        if($json_response["status"]["status"]=='APPROVED'){
            $estado='PAYED';
        }
        $order->status = $estado;
        $order->save();
    
        $status = $estado;
        $reason = $json_response["status"]["reason"];
        $message= $json_response["status"]["message"];
        $fecha  = $json_response["status"]["date"];
        $valor  = $json_response["request"]["payment"]["amount"]["total"];

        return view("orders.status_session")->with("status",$status)
                                            ->with("reason",$reason)
                                            ->with("message",$message)
                                            ->with("fecha",$fecha)
                                            ->with("valor",$valor)
                                            ->with("order_id",$id);

    }

}


