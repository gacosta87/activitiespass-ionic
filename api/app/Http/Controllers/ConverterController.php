<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Configuraciones;
use \App\Models\Banner;
use \App\module;



use Aspose\Words\WordsApi;
use Aspose\Words\Model\Requests\{ConvertDocumentRequest, SaveAsOnlineRequest, SaveAsRequest, SaveAsTiffOnlineRequest, SaveAsTiffRequest};
use Aspose\Words\Model\{DocxSaveOptionsData, HtmlSaveOptionsData, PdfSaveOptionsData, TiffSaveOptionsData, SaveOptionsData, HtmlFixedSaveOptionsData};
use PHPUnit\Framework\Assert;

use Aspose\Words\Model;
use Aspose\Words\Model\Requests;

use DB;
use Mail;




class ConverterController {


	public static function entrenamiento($formato = "txt", $requestDocument= ""){
		$wordsApi = new WordsApi('8f3e8f4c-4550-49f4-86f1-12a6acb53561', '503328e235f01749aec0afecde6ab649');
		$request2 = new ConvertDocumentRequest(
		    $requestDocument, $formato, NULL, NULL, NULL, NULL
		);
		$convert = $wordsApi->convertDocument($request2);
		$ruta    = $convert->getPathname();
		$datos   = file_get_contents($ruta);
		unlink($ruta);
		unlink($requestDocument);

		$mensaje_recibio_text  = "hazme un resumen de un texto que te voy a proporcionar, ";
		$mensaje_recibio_text .= "el resumen debe contar con informacion referente a productos o servicios con sus características y precios, métodos de pago, dirección, y informacion referente a el negocio, ";
		$mensaje_recibio_text .= "en el resumen no quiero que lo comiences con titulo ni que me digas algo como: 'el resumen es el siguiente' solo dame el resumen sin decirme mas nada, ";
		$mensaje_recibio_text .= "El texto al que quiero el resumen es el siguiente: ".$datos;
		$data_chat[] = array('role'=>'user', 'content'=>$mensaje_recibio_text);
		$curl = curl_init();
    	$post = array(
    		"model" => "gpt-3.5-turbo",			    	
    		"messages" => $data_chat
    	);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => json_encode($post),
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.env('OPENIAKEY'),
		    'Content-Type: application/json'
		  ),
		)); 
		$response1 = json_decode(curl_exec($curl));
		curl_close($curl);

		$datos = $response1->choices[0]->message->content;

		return $datos;
    }//fin function


}