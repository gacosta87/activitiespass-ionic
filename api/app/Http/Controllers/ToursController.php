<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Tours;

use \App\Models\Langs;
use \App\Models\Categories;
use \App\Models\CategoriesTours;
use \App\Models\ProvidedOptions;
use \App\Models\ToursProvidedOptions;
use \App\Models\Suppliers;
use \App\Models\TourMinPrices;
use \App\Models\Messages;
use \App\Models\TourPackages;
use \App\Models\TourPhotos;
use \App\Models\TourVideos;
use \App\Models\TourSchedules;

use \App\module;

use DB;
use Mail;
use DateTime;

use App\Http\Controllers\Controller;
use JWTAuth;

class ToursController extends Controller
{


	public function listtours(Request $request){
        $data  = $request->json()->all();
        $latitud = 0;
        $longitud = 0;
        $result = array();
        if(isset($data['lat']) && $data['lat']!=null && $data['lat']!=0){

        	$latitud  = $data['lat'];
        	$longitud = $data['lon'];

        	$datos = Tours::select('*', DB::raw('(SELECT (acos(sin(radians(lat)) * sin(radians('.$latitud.')) + cos(radians(lat)) * cos(radians('.$latitud.')) *  cos(radians(lon) - radians('.$longitud.'))) * 6378)) as  distanciageolocate'))->orderBy('distanciageolocate', 'desc')->limit(15)->get()->toArray();

        }else{
        	$cURL = curl_init();
			curl_setopt($cURL, CURLOPT_URL, 'https://api.ipgeolocation.io/ipgeo?apiKey=87d8dd022da947d29bf49511170fe850&ip='.$_SERVER['REMOTE_ADDR'].'' );
            curl_setopt($cURL, CURLOPT_HTTPGET, true);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json'
            ));

			$result = json_decode(curl_exec($cURL));
			curl_close( $cURL );
        	$latitud  = $result->latitude;
        	$longitud = $result->longitude;

        	$datos = Tours::select('*', DB::raw('(SELECT (acos(sin(radians(lat)) * sin(radians('.$latitud.')) + cos(radians(lat)) * cos(radians('.$latitud.')) *  cos(radians(lon) - radians('.$longitud.'))) * 6378)) as  distanciageolocate'))->orderBy('distanciageolocate', 'desc')->limit(15)->get()->toArray();

            
        }


        #listar las categorias de la actividad
        $listcategorias = DB::select("SELECT 
        `Categories`.`id` AS `Categories__id`, 
        `Categories`.`parent_id` AS `Categories__parent_id`, 
        `Categories`.`lft` AS `Categories__lft`, 
        `Categories`.`rght` AS `Categories__rght`, 
        `Categories`.`name` AS `Categories__name`,  
        `Categories`.`slug` AS `Categories__slug`, 
        `Categories`.`photo` AS `Categories__photo`, 
        `Categories`.`photo_dir` AS `Categories__photo_dir`, 
        `Categories`.`created` AS `Categories__created`, 
        `Categories`.`modified` AS `Categories__modified` 
        FROM `categories` `Categories`");


        
        return response()->json([
            'datos'=>$datos,
            'code'=>200,
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'latitud'  => $latitud,
            'longitud' => $longitud,
            'listcategorias'=> $listcategorias,
            'result'=>$result                   
        ],200);
    }//fin function








    public function listtoursfilter(Request $request){
        $data  = $request->json()->all();
        $latitud = 0;
        $longitud = 0;
        $result = array();

        $categoria = isset($data['selectedCategory'])?$data['selectedCategory']:"0";
        $distancia = isset($data['selectedDistance'])?$data['selectedDistance']:"0";

        $medida = "6378";
        if($distancia!="0"){
            if($distancia=="2000"){$distancia="";}
            $medida = $distancia * 1.609;
        }


        if(isset($data['lat']) && $data['lat']!=null && $data['lat']!=0){

        	$latitud  = $data['lat'];
        	$longitud = $data['lon'];


            if($categoria=="0"){
                $datos = Tours::select('*', DB::raw('( SELECT (acos(sin(radians(lat)) * sin(radians('.$latitud.')) + cos(radians(lat)) * cos(radians('.$latitud.')) *  cos(radians(lon) - radians('.$longitud.'))) * '.$medida.')) as  distanciageolocate'))->orderBy('distanciageolocate', 'desc')->limit(15)->get()->toArray();
            }else{
                $datos = Tours::select('*', DB::raw('( SELECT (acos(sin(radians(lat)) * sin(radians('.$latitud.')) + cos(radians(lat)) * cos(radians('.$latitud.')) *  cos(radians(lon) - radians('.$longitud.'))) * '.$medida.')) as  distanciageolocate')
                )->where(DB::raw('(select a.category_id from categories_tours a where a.tour_id=id limit 1)'), "=", $categoria)->orderBy('distanciageolocate', 'desc')->limit(15)->get()->toArray();
            }

        	

        }else{
        	$cURL = curl_init();
			curl_setopt($cURL, CURLOPT_URL, 'https://api.ipgeolocation.io/ipgeo?apiKey=87d8dd022da947d29bf49511170fe850&ip='.$_SERVER['REMOTE_ADDR'].'' );
            curl_setopt($cURL, CURLOPT_HTTPGET, true);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json'
            ));

			$result = json_decode(curl_exec($cURL));
			curl_close( $cURL );
        	$latitud  = $result->latitude;
        	$longitud = $result->longitude;

            if($categoria=="0"){
                $datos = Tours::select('*', DB::raw('(SELECT (acos(sin(radians(lat)) * sin(radians('.$latitud.')) + cos(radians(lat)) * cos(radians('.$latitud.')) *  cos(radians(lon) - radians('.$longitud.'))) * '.$medida.')) as  distanciageolocate'))->orderBy('distanciageolocate', 'desc')->limit(15)->get()->toArray();
            }else{
                $datos = Tours::select('*', DB::raw(' (SELECT (acos(sin(radians(lat)) * sin(radians('.$latitud.')) + cos(radians(lat)) * cos(radians('.$latitud.')) *  cos(radians(lon) - radians('.$longitud.'))) * '.$medida.')) as  distanciageolocate')
                )->where(DB::raw('(select a.category_id from categories_tours a where a.tour_id=id limit 1)'), "=", $categoria)->orderBy('distanciageolocate', 'desc')->limit(15)->get()->toArray();
            }

        	

            
        }


        #listar las categorias de la actividad
        $listcategorias = DB::select("SELECT 
        `Categories`.`id` AS `Categories__id`, 
        `Categories`.`parent_id` AS `Categories__parent_id`, 
        `Categories`.`lft` AS `Categories__lft`, 
        `Categories`.`rght` AS `Categories__rght`, 
        `Categories`.`name` AS `Categories__name`, 
        `Categories`.`slug` AS `Categories__slug`, 
        `Categories`.`photo` AS `Categories__photo`, 
        `Categories`.`photo_dir` AS `Categories__photo_dir`, 
        `Categories`.`created` AS `Categories__created`, 
        `Categories`.`modified` AS `Categories__modified` 
        FROM `categories` `Categories`");


        
        return response()->json([
            'datos'=>$datos,
            'code'=>200,
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'latitud'  => $latitud,
            'longitud' => $longitud,
            'listcategorias'=> $listcategorias,
            'result'=>$result                   
        ],200);
    }//fin function


























 
    public function listtoursid(Request $request){

            $data  = $request->json()->all();


            #Lista de idiomas disponibles para la actividad
$langs = DB::select("SELECT 
            `langs`.`id`,
            `langs`.`name`,
            `langs`.`iso`,
            `langs`.`photo`,
            `langs`.`photo_dir`
            FROM 
            `langs`");






            #listar las categorias de la actividad
$listcategorias = DB::select("SELECT 
            `Categories`.`id` AS `Categories__id`, 
            `Categories`.`parent_id` AS `Categories__parent_id`, 
            `Categories`.`lft` AS `Categories__lft`, 
            `Categories`.`rght` AS `Categories__rght`, 
            `Categories`.`name` AS `Categories__name`, 
            `Categories`.`slug` AS `Categories__slug`, 
            `Categories`.`photo` AS `Categories__photo`, 
            `Categories`.`photo_dir` AS `Categories__photo_dir`, 
            `Categories`.`created` AS `Categories__created`, 
            `Categories`.`modified` AS `Categories__modified` 
            FROM `categories` `Categories` 
            INNER JOIN `categories_tours` `CategoriesTours` ON `Categories`.`id` = (`CategoriesTours`.`category_id`) 
            WHERE `CategoriesTours`.`tour_id` in ('".$data['id']."')");







            #Lista lo que proporciona de forma extra la actividad
$listformaextra = DB::select("SELECT 
            `ProvidedOptions`.`id` AS `ProvidedOptions__id`, 
            `ProvidedOptions`.`type` AS `ProvidedOptions__type`, 
            `ProvidedOptions`.`name` AS `ProvidedOptions__name`, 
            `ProvidedOptions`.`photo` AS `ProvidedOptions__photo`, 
            `ProvidedOptions`.`photo_dir` AS `ProvidedOptions__photo_dir`, 
            `ProvidedOptions`.`created` AS `ProvidedOptions__created`, 
            `ProvidedOptions`.`modified` AS `ProvidedOptions__modified` 
            FROM 
            `provided_options` `ProvidedOptions` 
            INNER JOIN `tours_provided_options` `ToursProvidedOptions` ON `ProvidedOptions`.`id` = (
            `ToursProvidedOptions`.`provided_option_id`
            ) 
            WHERE 
            `ToursProvidedOptions`.`tour_id` in ('".$data['id']."')");









            #Información del paquete principal de la actividad
$paqueteprincipal = DB::select("SELECT 
            `Tours`.`id` AS `Tours__id`, 
            `Tours`.`supplier_id` AS `Tours__supplier_id`, 
            `Tours`.`internal_category_id` AS `Tours__internal_category_id`, 
            `Tours`.`currency_id` AS `Tours__currency_id`, 
            `Tours`.`message_id` AS `Tours__message_id`, 
            `Tours`.`type` AS `Tours__type`, 
            `Tours`.`code` AS `Tours__code`, 
            `Tours`.`name` AS `Tours__name`, 
            `Tours`.`slug` AS `Tours__slug`, 
            `Tours`.`option_name` AS `Tours__option_name`, 
            `Tours`.`description` AS `Tours__description`, 
            `Tours`.`description_new` AS `Tours__description_new`, 
            `Tours`.`description_long` AS `Tours__description_long`, 
            `Tours`.`description_long_new` AS `Tours__description_long_new`, 
            `Tours`.`restrictions` AS `Tours__restrictions`, 
            `Tours`.`show_message_some_restrictions_apply` AS `Tours__show_message_some_restrictions_apply`, 
            `Tours`.`infant_show_field` AS `Tours__infant_show_field`, 
            `Tours`.`infant_price` AS `Tours__infant_price`, 
            `Tours`.`infant_cost` AS `Tours__infant_cost`, 
            `Tours`.`infant_max_discount` AS `Tours__infant_max_discount`, 
            `Tours`.`infant_max_discount2` AS `Tours__infant_max_discount2`, 
            `Tours`.`infant_margin` AS `Tours__infant_margin`, 
            `Tours`.`infant_margin_percentage` AS `Tours__infant_margin_percentage`, 
            `Tours`.`child_price` AS `Tours__child_price`, 
            `Tours`.`child_cost` AS `Tours__child_cost`, 
            `Tours`.`child_max_discount` AS `Tours__child_max_discount`, 
            `Tours`.`child_max_discount2` AS `Tours__child_max_discount2`, 
            `Tours`.`child_margin` AS `Tours__child_margin`, 
            `Tours`.`child_margin_percentage` AS `Tours__child_margin_percentage`, 
            `Tours`.`adult_price` AS `Tours__adult_price`, 
            `Tours`.`adult_cost` AS `Tours__adult_cost`, 
            `Tours`.`adult_max_discount` AS `Tours__adult_max_discount`, 
            `Tours`.`adult_max_discount2` AS `Tours__adult_max_discount2`, 
            `Tours`.`adult_margin` AS `Tours__adult_margin`, 
            `Tours`.`adult_margin_percentage` AS `Tours__adult_margin_percentage`, 
            `Tours`.`senior_price` AS `Tours__senior_price`, 
            `Tours`.`senior_cost` AS `Tours__senior_cost`, 
            `Tours`.`senior_max_discount` AS `Tours__senior_max_discount`, 
            `Tours`.`senior_max_discount2` AS `Tours__senior_max_discount2`, 
            `Tours`.`senior_margin` AS `Tours__senior_margin`, 
            `Tours`.`senior_margin_percentage` AS `Tours__senior_margin_percentage`, 
            `Tours`.`min_age` AS `Tours__min_age`, 
            `Tours`.`cutoff` AS `Tours__cutoff`, 
            `Tours`.`free_cancelation` AS `Tours__free_cancelation`, 
            `Tours`.`days_to_expire` AS `Tours__days_to_expire`, 
            `Tours`.`minimum_number_of_passengers` AS `Tours__minimum_number_of_passengers`, 
            `Tours`.`maximum_number_of_passengers` AS `Tours__maximum_number_of_passengers`, 
            `Tours`.`roundtrip` AS `Tours__roundtrip`, 
            `Tours`.`promotional_code_percentage` AS `Tours__promotional_code_percentage`, 
            `Tours`.`promotional_code2_percentage` AS `Tours__promotional_code2_percentage`, 
            `Tours`.`promotional_code3_percentage` AS `Tours__promotional_code3_percentage`, 
            `Tours`.`is_combo` AS `Tours__is_combo`, 
            `Tours`.`is_for_residents` AS `Tours__is_for_residents`, 
            `Tours`.`popularity` AS `Tours__popularity`, 
            `Tours`.`show_home` AS `Tours__show_home`, 
            `Tours`.`show_map` AS `Tours__show_map`, 
            `Tours`.`address` AS `Tours__address`, 
            `Tours`.`lat` AS `Tours__lat`, 
            `Tours`.`lon` AS `Tours__lon`, 
            `Tours`.`immediate_confirmation` AS `Tours__immediate_confirmation`, 
            `Tours`.`immediate_confirmation_passengers` AS `Tours__immediate_confirmation_passengers`, 
            `Tours`.`immediate_confirmation_type` AS `Tours__immediate_confirmation_type`, 
            `Tours`.`stars` AS `Tours__stars`, 
            `Tours`.`payment_online` AS `Tours__payment_online`, 
            `Tours`.`is_a_unit` AS `Tours__is_a_unit`, 
            `Tours`.`duration` AS `Tours__duration`, 
            `Tours`.`status` AS `Tours__status`, 
            `Tours`.`created` AS `Tours__created`, 
            `Tours`.`modified` AS `Tours__modified`, 
            `Suppliers`.`id` AS `Suppliers__id`, 
            `Suppliers`.`user_id` AS `Suppliers__user_id`, 
            `Suppliers`.`name` AS `Suppliers__name`, 
            `Suppliers`.`slug` AS `Suppliers__slug`, 
            `Suppliers`.`commercial_name` AS `Suppliers__commercial_name`, 
            `Suppliers`.`tax` AS `Suppliers__tax`, 
            `Suppliers`.`license_number` AS `Suppliers__license_number`, 
            `Suppliers`.`website` AS `Suppliers__website`, 
            `Suppliers`.`email` AS `Suppliers__email`, 
            `Suppliers`.`photo` AS `Suppliers__photo`, 
            `Suppliers`.`photo_dir` AS `Suppliers__photo_dir`, 
            `Suppliers`.`phone` AS `Suppliers__phone`, 
            `Suppliers`.`phone2` AS `Suppliers__phone2`, 
            `Suppliers`.`file_contract` AS `Suppliers__file_contract`, 
            `Suppliers`.`file_contract_dir` AS `Suppliers__file_contract_dir`, 
            `Suppliers`.`date_start_contract` AS `Suppliers__date_start_contract`, 
            `Suppliers`.`date_end_contract` AS `Suppliers__date_end_contract`, 
            `Suppliers`.`self_renewal_contract` AS `Suppliers__self_renewal_contract`, 
            `Suppliers`.`reservations_dept_email` AS `Suppliers__reservations_dept_email`, 
            `Suppliers`.`reservations_dept_email2` AS `Suppliers__reservations_dept_email2`, 
            `Suppliers`.`reservations_dept_phone` AS `Suppliers__reservations_dept_phone`, 
            `Suppliers`.`reservations_dept_phone2` AS `Suppliers__reservations_dept_phone2`, 
            `Suppliers`.`emergency_after_hours_phone` AS `Suppliers__emergency_after_hours_phone`, 
            `Suppliers`.`liability_insurance_company` AS `Suppliers__liability_insurance_company`, 
            `Suppliers`.`liability_insurance_policy_number` AS `Suppliers__liability_insurance_policy_number`, 
            `Suppliers`.`liability_insurance_policy_coverage_coin` AS `Suppliers__liability_insurance_policy_coverage_coin`, 
            `Suppliers`.`liability_insurance_policy_coverage_amount` AS `Suppliers__liability_insurance_policy_coverage_amount`, 
            `Suppliers`.`liability_insurance_policy_expiration` AS `Suppliers__liability_insurance_policy_expiration`, 
            `Suppliers`.`upload_insurance_policy` AS `Suppliers__upload_insurance_policy`, 
            `Suppliers`.`upload_insurance_policy_dir` AS `Suppliers__upload_insurance_policy_dir`, 
            `Suppliers`.`credit_days` AS `Suppliers__credit_days`, 
            `Suppliers`.`name_bank` AS `Suppliers__name_bank`, 
            `Suppliers`.`bank_address` AS `Suppliers__bank_address`, 
            `Suppliers`.`bank_phone` AS `Suppliers__bank_phone`, 
            `Suppliers`.`routing_number` AS `Suppliers__routing_number`, 
            `Suppliers`.`swift_number` AS `Suppliers__swift_number`, 
            `Suppliers`.`account_number` AS `Suppliers__account_number`, 
            `Suppliers`.`beneficiary` AS `Suppliers__beneficiary`, 
            `Suppliers`.`infant_age_min` AS `Suppliers__infant_age_min`, 
            `Suppliers`.`infant_age_max` AS `Suppliers__infant_age_max`, 
            `Suppliers`.`child_age_min` AS `Suppliers__child_age_min`, 
            `Suppliers`.`child_age_max` AS `Suppliers__child_age_max`, 
            `Suppliers`.`adult_age_min` AS `Suppliers__adult_age_min`, 
            `Suppliers`.`adult_age_max` AS `Suppliers__adult_age_max`, 
            `Suppliers`.`senior_age_min` AS `Suppliers__senior_age_min`, 
            `Suppliers`.`senior_age_max` AS `Suppliers__senior_age_max`, 
            `Suppliers`.`show_rates` AS `Suppliers__show_rates`, 
            `Suppliers`.`checkin_username` AS `Suppliers__checkin_username`, 
            `Suppliers`.`checkin_password` AS `Suppliers__checkin_password`, 
            `Suppliers`.`status` AS `Suppliers__status`, 
            `Suppliers`.`created` AS `Suppliers__created`, 
            `Suppliers`.`modified` AS `Suppliers__modified`, 
            `TourMinPrices`.`tour_id` AS `TourMinPrices__tour_id`, 
            `TourMinPrices`.`infant_price` AS `TourMinPrices__infant_price`, 
            `TourMinPrices`.`infant_cost` AS `TourMinPrices__infant_cost`, 
            `TourMinPrices`.`infant_max_discount` AS `TourMinPrices__infant_max_discount`, 
            `TourMinPrices`.`infant_max_discount2` AS `TourMinPrices__infant_max_discount2`, 
            `TourMinPrices`.`child_price` AS `TourMinPrices__child_price`, 
            `TourMinPrices`.`child_cost` AS `TourMinPrices__child_cost`, 
            `TourMinPrices`.`child_max_discount` AS `TourMinPrices__child_max_discount`, 
            `TourMinPrices`.`child_max_discount2` AS `TourMinPrices__child_max_discount2`, 
            `TourMinPrices`.`adult_price` AS `TourMinPrices__adult_price`, 
            `TourMinPrices`.`adult_cost` AS `TourMinPrices__adult_cost`, 
            `TourMinPrices`.`adult_max_discount` AS `TourMinPrices__adult_max_discount`, 
            `TourMinPrices`.`adult_max_discount2` AS `TourMinPrices__adult_max_discount2`, 
            `TourMinPrices`.`senior_price` AS `TourMinPrices__senior_price`, 
            `TourMinPrices`.`senior_cost` AS `TourMinPrices__senior_cost`, 
            `TourMinPrices`.`senior_max_discount` AS `TourMinPrices__senior_max_discount`, 
            `TourMinPrices`.`senior_max_discount2` AS `TourMinPrices__senior_max_discount2`, 
            `Messages`.`id` AS `Messages__id`, 
            `Messages`.`name` AS `Messages__name`, 
            `Messages`.`created` AS `Messages__created`, 
            `Messages`.`modified` AS `Messages__modified` 
            FROM 
            `tours` `Tours` 
            INNER JOIN `suppliers` `Suppliers` ON (
            `Suppliers`.`status` = 1 
            AND `Suppliers`.`id` = (`Tours`.`supplier_id`)
            ) 
            LEFT JOIN `tour_min_prices` `TourMinPrices` ON `Tours`.`id` = (`TourMinPrices`.`tour_id`) 
            LEFT JOIN `messages` `Messages` ON `Messages`.`id` = (`Tours`.`message_id`) 
            WHERE 
            (
            `Tours`.`slug` = 'karate-academy' 
            AND `Tours`.`status` = 1
            ) 
            LIMIT 
            1");








            #Lista de paquetes adicionales de la actividad
$paquetesadicionalesdelaactividad = DB::select("SELECT 
            `TourPackages`.`id` AS `TourPackages__id`, 
            `TourPackages`.`tour_id` AS `TourPackages__tour_id`, 
            `TourPackages`.`code` AS `TourPackages__code`, 
            `TourPackages`.`name` AS `TourPackages__name`, 
            `TourPackages`.`slug` AS `TourPackages__slug`, 
            `TourPackages`.`option_name` AS `TourPackages__option_name`, 
            `TourPackages`.`description` AS `TourPackages__description`, 
            `TourPackages`.`description_new` AS `TourPackages__description_new`, 
            `TourPackages`.`description_long` AS `TourPackages__description_long`, 
            `TourPackages`.`description_long_new` AS `TourPackages__description_long_new`, 
            `TourPackages`.`restrictions` AS `TourPackages__restrictions`, 
            `TourPackages`.`show_message_some_restrictions_apply` AS `TourPackages__show_message_some_restrictions_apply`, 
            `TourPackages`.`infant_show_field` AS `TourPackages__infant_show_field`, 
            `TourPackages`.`infant_price` AS `TourPackages__infant_price`, 
            `TourPackages`.`infant_cost` AS `TourPackages__infant_cost`, 
            `TourPackages`.`infant_max_discount` AS `TourPackages__infant_max_discount`, 
            `TourPackages`.`infant_max_discount2` AS `TourPackages__infant_max_discount2`, 
            `TourPackages`.`infant_margin` AS `TourPackages__infant_margin`, 
            `TourPackages`.`infant_margin_percentage` AS `TourPackages__infant_margin_percentage`, 
            `TourPackages`.`child_price` AS `TourPackages__child_price`, 
            `TourPackages`.`child_cost` AS `TourPackages__child_cost`, 
            `TourPackages`.`child_max_discount` AS `TourPackages__child_max_discount`, 
            `TourPackages`.`child_max_discount2` AS `TourPackages__child_max_discount2`, 
            `TourPackages`.`child_margin` AS `TourPackages__child_margin`, 
            `TourPackages`.`child_margin_percentage` AS `TourPackages__child_margin_percentage`, 
            `TourPackages`.`adult_price` AS `TourPackages__adult_price`, 
            `TourPackages`.`adult_cost` AS `TourPackages__adult_cost`, 
            `TourPackages`.`adult_max_discount` AS `TourPackages__adult_max_discount`, 
            `TourPackages`.`adult_max_discount2` AS `TourPackages__adult_max_discount2`, 
            `TourPackages`.`adult_margin` AS `TourPackages__adult_margin`, 
            `TourPackages`.`adult_margin_percentage` AS `TourPackages__adult_margin_percentage`, 
            `TourPackages`.`senior_price` AS `TourPackages__senior_price`, 
            `TourPackages`.`senior_cost` AS `TourPackages__senior_cost`, 
            `TourPackages`.`senior_max_discount` AS `TourPackages__senior_max_discount`, 
            `TourPackages`.`senior_max_discount2` AS `TourPackages__senior_max_discount2`, 
            `TourPackages`.`senior_margin` AS `TourPackages__senior_margin`, 
            `TourPackages`.`senior_margin_percentage` AS `TourPackages__senior_margin_percentage`, 
            `TourPackages`.`min_age` AS `TourPackages__min_age`, 
            `TourPackages`.`cutoff` AS `TourPackages__cutoff`, 
            `TourPackages`.`free_cancelation` AS `TourPackages__free_cancelation`, 
            `TourPackages`.`days_to_expire` AS `TourPackages__days_to_expire`, 
            `TourPackages`.`minimum_number_of_passengers` AS `TourPackages__minimum_number_of_passengers`, 
            `TourPackages`.`maximum_number_of_passengers` AS `TourPackages__maximum_number_of_passengers`, 
            `TourPackages`.`roundtrip` AS `TourPackages__roundtrip`, 
            `TourPackages`.`promotional_code_percentage` AS `TourPackages__promotional_code_percentage`, 
            `TourPackages`.`promotional_code2_percentage` AS `TourPackages__promotional_code2_percentage`, 
            `TourPackages`.`promotional_code3_percentage` AS `TourPackages__promotional_code3_percentage`, 
            `TourPackages`.`is_for_residents` AS `TourPackages__is_for_residents`, 
            `TourPackages`.`is_a_unit` AS `TourPackages__is_a_unit`, 
            `TourPackages`.`duration` AS `TourPackages__duration`, 
            `TourPackages`.`status` AS `TourPackages__status`, 
            `TourPackages`.`created` AS `TourPackages__created`, 
            `TourPackages`.`modified` AS `TourPackages__modified` 
            FROM 
            `tour_packages` `TourPackages` 
            WHERE 
            (
            `TourPackages`.`status` = 1 
            AND `TourPackages`.`tour_id` in ('".$data['id']."')
            ) 
            ORDER BY 
            `TourPackages`.`adult_price` ASC");






            


            #Lista de fotos de la galeria de la actividad
$listadegaleriafoto = DB::select("SELECT 
            `TourPhotos`.`id` AS `TourPhotos__id`, 
            `TourPhotos`.`tour_id` AS `TourPhotos__tour_id`, 
            `TourPhotos`.`photo` AS `TourPhotos__photo`, 
            `TourPhotos`.`photo_dir` AS `TourPhotos__photo_dir`, 
            `TourPhotos`.`cover` AS `TourPhotos__cover`, 
            `TourPhotos`.`order` AS `TourPhotos__order`, 
            `TourPhotos`.`modify_option` AS `TourPhotos__modify_option`, 
            `TourPhotos`.`created` AS `TourPhotos__created`, 
            `TourPhotos`.`modified` AS `TourPhotos__modified` 
            FROM 
            `tour_photos` `TourPhotos` 
            WHERE 
            (
            (`TourPhotos`.`tour_package_id`) IS NULL 
            AND `TourPhotos`.`tour_id` in ('".$data['id']."')
            ) 
            ORDER BY 
            TourPhotos.cover DESC, 
            TourPhotos.order IS NULL ASC, 
            TourPhotos.order ASC");







            


            #Lista de videos de la galeria de la actividad
$listadegaleriavideo = DB::select("SELECT 
            `TourVideos`.`id` AS `TourPhotos__id`, 
            `TourVideos`.`tour_id` AS `TourPhotos__tour_id`, 
            `TourVideos`.`url` AS `TourPhotos__url`,
            `TourVideos`.`created` AS `TourPhotos__created`, 
            `TourVideos`.`modified` AS `TourPhotos__modified` 
            FROM 
            `tour_videos` `TourVideos` 
            WHERE 
            (
            (`TourVideos`.`tour_package_id`) IS NULL 
            AND `TourVideos`.`tour_id` in ('".$data['id']."')
            )"); 







            



            #Lista de calendarios habilitado para el paquete principal de la actividad
$listacalendarioactividadespaqueteprincipal = DB::select("SELECT 
            `TourSchedules`.`id` AS `TourSchedules__id`, 
            `TourSchedules`.`tour_package_id` AS `TourSchedules__tour_package_id`, 
            `TourSchedules`.`instructor_id` AS `TourSchedules__instructor_id`, 
            `TourSchedules`.`date_start` AS `TourSchedules__date_start`, 
            `TourSchedules`.`date_end` AS `TourSchedules__date_end`, 
            `TourSchedules`.`time_start` AS `TourSchedules__time_start`, 
            `TourSchedules`.`time_end` AS `TourSchedules__time_end`, 
            `TourSchedules`.`monday` AS `TourSchedules__monday`, 
            `TourSchedules`.`monday_available` AS `TourSchedules__monday_available`, 
            `TourSchedules`.`monday_unlimited_sales` AS `TourSchedules__monday_unlimited_sales`, 
            `TourSchedules`.`monday_stop_sales` AS `TourSchedules__monday_stop_sales`, 
            `TourSchedules`.`tuesday` AS `TourSchedules__tuesday`, 
            `TourSchedules`.`tuesday_available` AS `TourSchedules__tuesday_available`, 
            `TourSchedules`.`tuesday_unlimited_sales` AS `TourSchedules__tuesday_unlimited_sales`, 
            `TourSchedules`.`tuesday_stop_sales` AS `TourSchedules__tuesday_stop_sales`, 
            `TourSchedules`.`wednesday` AS `TourSchedules__wednesday`, 
            `TourSchedules`.`wednesday_available` AS `TourSchedules__wednesday_available`, 
            `TourSchedules`.`wednesday_unlimited_sales` AS `TourSchedules__wednesday_unlimited_sales`, 
            `TourSchedules`.`wednesday_stop_sales` AS `TourSchedules__wednesday_stop_sales`, 
            `TourSchedules`.`thursday` AS `TourSchedules__thursday`, 
            `TourSchedules`.`thursday_available` AS `TourSchedules__thursday_available`, 
            `TourSchedules`.`thursday_unlimited_sales` AS `TourSchedules__thursday_unlimited_sales`, 
            `TourSchedules`.`thursday_stop_sales` AS `TourSchedules__thursday_stop_sales`, 
            `TourSchedules`.`friday` AS `TourSchedules__friday`, 
            `TourSchedules`.`friday_available` AS `TourSchedules__friday_available`, 
            `TourSchedules`.`friday_unlimited_sales` AS `TourSchedules__friday_unlimited_sales`, 
            `TourSchedules`.`friday_stop_sales` AS `TourSchedules__friday_stop_sales`, 
            `TourSchedules`.`saturday` AS `TourSchedules__saturday`, 
            `TourSchedules`.`saturday_available` AS `TourSchedules__saturday_available`, 
            `TourSchedules`.`saturday_unlimited_sales` AS `TourSchedules__saturday_unlimited_sales`, 
            `TourSchedules`.`saturday_stop_sales` AS `TourSchedules__saturday_stop_sales`, 
            `TourSchedules`.`sunday` AS `TourSchedules__sunday`, 
            `TourSchedules`.`sunday_available` AS `TourSchedules__sunday_available`, 
            `TourSchedules`.`sunday_unlimited_sales` AS `TourSchedules__sunday_unlimited_sales`, 
            `TourSchedules`.`sunday_stop_sales` AS `TourSchedules__sunday_stop_sales`, 
            `TourSchedules`.`book_before` AS `TourSchedules__book_before`, 
            `TourSchedules`.`book_before_time` AS `TourSchedules__book_before_time`, 
            `TourSchedules`.`status` AS `TourSchedules__status`, 
            `TourSchedules`.`created` AS `TourSchedules__created`, 
            `TourSchedules`.`modified` AS `TourSchedules__modified` 
            FROM 
            `tour_schedules` `TourSchedules` 
            WHERE 
            (
            (
            `TourSchedules`.`tour_package_id`
            ) IS NULL 
            AND `TourSchedules`.`tour_id` in ('".$data['id']."')
            )");



            




            #Lista de calendarios habilitado para los paquetes adicionales de la actividad
$listacalendarioactividadespaqueteadicionales = DB::select("SELECT 
            `TourSchedules`.`id` AS `TourSchedules__id`, 
            `TourSchedules`.`tour_id` AS `TourSchedules__tour_id`, 
            `TourSchedules`.`instructor_id` AS `TourSchedules__instructor_id`, 
            `TourSchedules`.`date_start` AS `TourSchedules__date_start`, 
            `TourSchedules`.`date_end` AS `TourSchedules__date_end`, 
            `TourSchedules`.`time_start` AS `TourSchedules__time_start`, 
            `TourSchedules`.`time_end` AS `TourSchedules__time_end`, 
            `TourSchedules`.`monday` AS `TourSchedules__monday`, 
            `TourSchedules`.`monday_available` AS `TourSchedules__monday_available`, 
            `TourSchedules`.`monday_unlimited_sales` AS `TourSchedules__monday_unlimited_sales`, 
            `TourSchedules`.`monday_stop_sales` AS `TourSchedules__monday_stop_sales`, 
            `TourSchedules`.`tuesday` AS `TourSchedules__tuesday`, 
            `TourSchedules`.`tuesday_available` AS `TourSchedules__tuesday_available`, 
            `TourSchedules`.`tuesday_unlimited_sales` AS `TourSchedules__tuesday_unlimited_sales`, 
            `TourSchedules`.`tuesday_stop_sales` AS `TourSchedules__tuesday_stop_sales`, 
            `TourSchedules`.`wednesday` AS `TourSchedules__wednesday`, 
            `TourSchedules`.`wednesday_available` AS `TourSchedules__wednesday_available`, 
            `TourSchedules`.`wednesday_unlimited_sales` AS `TourSchedules__wednesday_unlimited_sales`, 
            `TourSchedules`.`wednesday_stop_sales` AS `TourSchedules__wednesday_stop_sales`, 
            `TourSchedules`.`thursday` AS `TourSchedules__thursday`, 
            `TourSchedules`.`thursday_available` AS `TourSchedules__thursday_available`, 
            `TourSchedules`.`thursday_unlimited_sales` AS `TourSchedules__thursday_unlimited_sales`, 
            `TourSchedules`.`thursday_stop_sales` AS `TourSchedules__thursday_stop_sales`, 
            `TourSchedules`.`friday` AS `TourSchedules__friday`, 
            `TourSchedules`.`friday_available` AS `TourSchedules__friday_available`, 
            `TourSchedules`.`friday_unlimited_sales` AS `TourSchedules__friday_unlimited_sales`, 
            `TourSchedules`.`friday_stop_sales` AS `TourSchedules__friday_stop_sales`, 
            `TourSchedules`.`saturday` AS `TourSchedules__saturday`, 
            `TourSchedules`.`saturday_available` AS `TourSchedules__saturday_available`, 
            `TourSchedules`.`saturday_unlimited_sales` AS `TourSchedules__saturday_unlimited_sales`, 
            `TourSchedules`.`saturday_stop_sales` AS `TourSchedules__saturday_stop_sales`, 
            `TourSchedules`.`sunday` AS `TourSchedules__sunday`, 
            `TourSchedules`.`sunday_available` AS `TourSchedules__sunday_available`, 
            `TourSchedules`.`sunday_unlimited_sales` AS `TourSchedules__sunday_unlimited_sales`, 
            `TourSchedules`.`sunday_stop_sales` AS `TourSchedules__sunday_stop_sales`, 
            `TourSchedules`.`book_before` AS `TourSchedules__book_before`, 
            `TourSchedules`.`book_before_time` AS `TourSchedules__book_before_time`, 
            `TourSchedules`.`status` AS `TourSchedules__status`, 
            `TourSchedules`.`created` AS `TourSchedules__created`, 
            `TourSchedules`.`modified` AS `TourSchedules__modified` 
            FROM 
            `tour_schedules` `TourSchedules` 
            WHERE 
            `TourSchedules`.`tour_package_id` in (6, 7, 8, 5, 1)");





            



            $datos = Tours::where('id', $data['id'])->get()->toArray();

            return response()->json([
            'datos'=>$datos,
            'listcategorias'=>$listcategorias,
            'listformaextra'=>$listformaextra,
            'paqueteprincipal'=>$paqueteprincipal,
            'paquetesadicionalesdelaactividad'=>$paquetesadicionalesdelaactividad,
            'listadegaleriafoto'=>$listadegaleriafoto,
            'listadegaleriavideo'=>$listadegaleriavideo,
            'listacalendarioactividadespaqueteprincipal'=>$listacalendarioactividadespaqueteprincipal,
            'listacalendarioactividadespaqueteadicionales'=>$listacalendarioactividadespaqueteadicionales
        ],200);

    }

}
?>