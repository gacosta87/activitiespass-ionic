<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Mycars;
use \App\Models\Suscripciones;

use Illuminate\Database\Eloquent\JsonEncodingException;

use \App\module;

use DB;
use Mail;


use App\Http\Controllers\Basic;
use App\Http\Controllers\Controller;
use JWTAuth;

class StripeController extends Controller
{



	public function checkout(Request $request){

			$query = $request->json()->all();
			$checkout_session1 = "";
			$checkout_session2 = "";
			$checkout_url      = "";

			$stripe = new \Stripe\StripeClient('sk_test_51NY8dTIvQ4OrylIqgKCUzvzOqX4SZwokcziKjUfvgYzwkLhDlG6t22rluGQxnsC6eCCUDIsCFs7ap1hksQdpWWLJ00WydoI6gL');

			$url_link = env('APP_URL');

			$plan_id = "price_1NaUmxIvQ4OrylIqn3fshMzu";

			$checkout_session1 = $stripe->checkout->sessions->create([
			  'line_items' => [[
			    'price' => $plan_id,
			    'quantity' => 1,
			  ]],
			  'subscription_data' => [
			    'trial_period_days' => 15,
			  ],
			  'mode' => 'subscription',
			  'success_url' => $url_link .'public/api/success',
			  'cancel_url'  => $url_link .'public/api/cancel',
			]);
			$checkout_url = $checkout_session1->url;
			

			/*$checkout_session1 =  $stripe->customers->create([
				'name'           => 'Maria medina', 
				'payment_method' => 'pm_card_visa',
				'invoice_settings' => ['default_payment_method' => 'pm_card_visa'],
			  	'description'      => 'ultima moda',
			]);

			$checkout_session2 =  $stripe->subscriptions->create([
			  'customer' => $checkout_session1->id,
			  'items' => [
			    ['price' => $plan_id],
			  ],
			  'trial_period_days' => 30
			]);*/


			$data_id  =  DB::table('suscripciones')->insertGetId(['usuario_id'  => $query['usuarioid'],
																   'mycar_id'   => $query['mycarid'],
																   'custome_id' => $checkout_session1->id,
				                                                   'plan_id'    => $plan_id,
				                                                   'monto'      => 9.99,
				                                                   'fecha'      => date('Y-m-d'),
				                                                   'created'    => date('Y-m-d H:i:s'),
				                                                   'modified'   => date('Y-m-d H:i:s'),
				                                                   'activo'     => 1
				                                                ]);

	 		return response()->json([
                'code'           => 200,
                'url'            => $checkout_url,
                'suscripciones1' => $checkout_session1,
                'suscripciones2' => $checkout_session2,
                'idsuscripcion'  => $data_id,
                'msg'            => 'Pago en proceso'                         
            ],200);


    }//fin function




    

    public function precios(Request $request){
        $data = $request->json()->all();

        $precios = DB::select(" 
        SELECT 
            Memberships.id AS Memberships__id, 
            Memberships.name AS Memberships__name, 
            Memberships.profile AS Memberships__profile, 
            Memberships.credit AS Memberships__credit, 
            Memberships.price AS Memberships__price, 
            Memberships.created AS Memberships__created, 
            Memberships.modified AS Memberships__modified, 
            Memberships.show AS Memberships__show 
        FROM 
            memberships Memberships 
        ORDER BY 
            Memberships.name ASC");

        return response()->json([
            'precios'=>$precios,
            'code'=>200                      
        ],200);

    }



    public function success(Request $request){
			$query = $request->json()->all();

            	



	 		return response()->json([
                'code'=>200,
                'msg'=>'Bienvenido'                         
            ],200);
    }//fin function



    public function cancel(Request $request){

			$query = $request->json()->all();


	 		return response()->json([
                'code'=>200,
                'msg'=>'Bienvenido'                         
            ],200);
    }//fin function


    public function cancelar_suscripcion(Request $request){

			$query = $request->json()->all();

			$stripe = new \Stripe\StripeClient('sk_test_51NY8dTIvQ4OrylIqgKCUzvzOqX4SZwokcziKjUfvgYzwkLhDlG6t22rluGQxnsC6eCCUDIsCFs7ap1hksQdpWWLJ00WydoI6gL');

			$stripe_data = $stripe->subscriptions->cancel('sub_1Nb1HYIvQ4OrylIqrZrJTFFe', []);


	 		return response()->json([
                'code'=>200,
                'datos'=>$stripe_data,
                'msg'=>'Bienvenido'                         
            ],200);
    }//fin function


}//class