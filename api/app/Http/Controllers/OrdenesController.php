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

class OrdenesController extends Controller
{

    public function consultarordenes(Request $request){
        $data  = $request->json()->all();


        //1.- Validar que el usuario actual no tenga una orden pendiente, en caso que tener una orden activa usarla para agregar una reserva.

        /**
         * constant status order.
         */
        define('ORDER_PENDING', 0);
        define('ORDER_ABANDONED', 1);
        define('ORDER_VOIDED', 2);
        define('ORDER_PAID', 3);
        define('ORDER_REFUNDED', 4);
        define('ORDER_CANCELLED', 5);
        define('ORDER_COMPLETED', 6);
        define('ORDER_NO_SHOW', 7);

        //para consultar una orden pendiente, en caso que exista la orden usar ese id para agregar el detalle de la reserva.
        $result1 = DB::select("SELECT
            orders.id
        FROM
            orders
        WHERE
            orders.`status` = ORDER_PENDING
            AND orders.guest_id = 1;");
            
        //si no existe se crea una orden nueva
        $result2 = DB::select("INSERT INTO orders SET guest_id = 1, `status` = ORDER_PENDING;");

        //capturar el id de la orden dependiendo de los casos indicados arriba e insertar el detalle. Aqui van datos relacionados a la actividad 
        //seleccionada, si es una actividad principal solo se registra el tour_id, si es un paquete de la actividad se colocar adicional el tour_package_id.
        //el campo tour_schedule_id corresponde al id del calendario seleccionado, lo que se realizo la ultima ves.
        //y los campos (`infant_price`, `child_price`, `adult_price`, `senior_price`) los precios viene de la actividad seleccionada y los valores (`infant`, `child`, `adult`, `senior`) son la cantidad de puesto reservar, esto se ingresa al momento de la reserva.
        $result3 = DB::select("INSERT INTO `order_details` (`order_id`, `tour_id`, `tour_package_id`, `tour_schedule_id`, `date`, `time`, `infant`, `infant_price`, `child`, `child_price`, `adult`, `adult_price`, `senior`, `senior_price`, `status`, `created`, `modified`) 
        VALUES 
        ('4', '1', null, '6', '2024-05-01', '15:00:00', '0', '0', '0', '0', '1', '20', '0', '0', '0', '2024-04-22 21:44:00', '2024-04-22 21:44:00');");

        //al momento de cambiar el status de la orden a ORDER_PAID que seria al momento de confirmar la reserva y hacer el pago 
        //(o en este caso descontar los creditos que tenga en la cuenta), se debe enviar un email al proveedor de la actividad 
        //informando de la reserva. En la tabla tours hay un campo foraneo a la tabla suppliers, que es donde estan los datos de contacto del proveedor.

        //complementar con la opción de actualizar y eliminar.

        return response()->json([
            'datos'=>$datos,
            'code'=>200,
            'result1'=>$result1,
            'result2'=>$result2,
            'result3'=>$result3                   
        ],200);

    }


    public function disponibilidad(Request $request){
        $data  = $request->json()->all();

        //VER DISPONIBILIDAD

        $result = DB::select("SELECT
        IF(monday = 1 AND monday_unlimited_sales = 1, 1, 0) as Mon,
        IF(ISNULL(monday_available), 'FULL', (monday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Monday'))) as mon_available,
        IF(tuesday = 1 AND tuesday_unlimited_sales = 1, 1, 0) as Tue,
        IF(ISNULL(tuesday_available), 'FULL', (tuesday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Tuesday'))) as Tue_available,
        IF(wednesday = 1 AND wednesday_unlimited_sales = 1, 1, 0) as Wed,
        IF(ISNULL(wednesday_available), 'FULL', (wednesday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Wednesday'))) as Wed_available,
        IF(thursday = 1 AND thursday_unlimited_sales = 1, 1, 0) as Thu,
        IF(ISNULL(thursday_available), 'FULL', (thursday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Thursday'))) as Thu_available,
        IF(friday = 1 AND friday_unlimited_sales = 1, 1, 0) as Fri,
        IF(ISNULL(friday_available), 'FULL', (friday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Friday'))) as Fri_available,
        IF(saturday = 1 AND saturday_unlimited_sales = 1, 1, 0) as Sat,
        IF(ISNULL(saturday_available), 'FULL', (saturday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Saturday'))) as Sat_available,
        IF(sunday = 1 AND sunday_unlimited_sales = 1, 1, 0) as Sun,
        IF(ISNULL(sunday_available), 'FULL', (sunday_available - (SELECT (infant + child + adult+ senior) FROM order_details WHERE tour_id = 1 AND  ISNULL(tour_package_id) AND date = '2023-12-20' AND DAYNAME(date) = 'Sunday'))) as Sun_available,
        time_start,
        time_end,
        instructor_id,
        instructors.first_name,
        instructors.last_name
        FROM
        tour_schedules
        LEFT JOIN instructors ON tour_schedules.instructor_id = instructors.id
        WHERE
        tour_id = 1
        AND ISNULL(tour_package_id)
        AND '2023-12-20' BETWEEN date_start AND date_end"); 


        //Los parámetros de entrada serían la fecha del día que quieres conocer, id del tour_id que sería la actividad principal
        //Y tour_packege_id opcional si se trata de una variante de la actividad principal

        return response()->json([
            'datos'=>$datos,
            'code'=>200,
            'result'=>$result                   
        ],200);

    }



}
?>