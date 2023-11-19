<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Mycars'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Mycars'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Edit Mycar'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Mycar', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
			
echo $this->Form->input('id', array('class'=>'form-horizontal'));	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarrif">Rif</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('rif', array('id'=>'Mycarrif', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarrazon_social">Razón social</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('razon_social', array('id'=>'Mycarrazon_social', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarrepresentante">Representante</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('representante', array('id'=>'Mycarrepresentante', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarrepresentante">Descripción</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('descripcion', array('id'=>'Mycarrepresentante', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarmycartipo_id">Mycartipo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('mycartipo_id', array('id'=>'Mycarmycartipo_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarorden">Orden</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('orden', array('id'=>'Mycarorden', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycaremail">Email</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('email', array('id'=>'Mycaremail', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartelefono">Teléfono</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('telefono', array('id'=>'Mycartelefono', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarwebsite">Website</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('website', array('id'=>'Mycarwebsite', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycardireccion">Dirección</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('direccion', array('id'=>'Mycardireccion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	

	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarfoto1">Foto1</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('foto1', array('type'=>'file', 'id'=>'Mycarfoto1', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Tiposerviciodenominacion">Foto1</label>';    
echo'<div class="col-md-9">'; 
?>
<img src="<?= $this->Html->webroot($this->data['Mycar']['foto1']) ?>" height="80" width="100">
<?php   
echo '</div>';  
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarfoto2">Foto2</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('foto2', array('type'=>'file', 'id'=>'Mycarfoto2', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Tiposerviciodenominacion">Foto2</label>';    
echo'<div class="col-md-9">'; 
?>
<img src="<?= $this->Html->webroot($this->data['Mycar']['foto2']) ?>" height="80" width="100">
<?php   
echo '</div>';  
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarfoto3">Foto3</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('foto3', array('type'=>'file', 'id'=>'Mycarfoto3', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Tiposerviciodenominacion">Foto3</label>';    
echo'<div class="col-md-9">'; 
?>
<img src="<?= $this->Html->webroot($this->data['Mycar']['foto3']) ?>" height="80" width="100">
<?php   
echo '</div>';  
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarfoto4">Foto4</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('foto4', array('type'=>'file', 'id'=>'Mycarfoto4', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Tiposerviciodenominacion">Foto4</label>';    
echo'<div class="col-md-9">'; 
?>
<img src="<?= $this->Html->webroot($this->data['Mycar']['foto4']) ?>" height="80" width="100">
<?php   
echo '</div>';  
echo '</div>';


echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarlunes">Lunes</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('lunes', array('type'=>'checkbox', 'id'=>'Mycarlunes', 'div'=>false, 'label'=>false, 'class'=>''));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarmartes">Martes</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('martes', array('type'=>'checkbox', 'id'=>'Mycarmartes', 'div'=>false, 'label'=>false, 'class'=>''));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarmiercoles">Miercoles</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('miercoles', array('type'=>'checkbox', 'id'=>'Mycarmiercoles', 'div'=>false, 'label'=>false, 'class'=>''));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarjueves">Jueves</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('jueves', array('type'=>'checkbox', 'id'=>'Mycarjueves', 'div'=>false, 'label'=>false, 'class'=>'l'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarviernes">Viernes</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('viernes', array('type'=>'checkbox', 'id'=>'Mycarviernes', 'div'=>false, 'label'=>false, 'class'=>''));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarsabado">Sabado</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('sabado', array('type'=>'checkbox', 'id'=>'Mycarsabado', 'div'=>false, 'label'=>false, 'class'=>''));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycardomingo">Domingo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('domingo', array('type'=>'checkbox', 'id'=>'Mycardomingo', 'div'=>false, 'label'=>false, 'class'=>''));		
echo '</div>';	
echo '</div>';


echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarlatitud">latitud</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('latitud', array('onBlur'=>'load__2();', 'id'=>'Mycarlatitud', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarlongitud">longitud</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('longitud', array('onBlur'=>'load__2();', 'id'=>'Mycarlongitud', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarpais">Pais</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('pais', array('readonly'=>true,  'id'=>'pais', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarestado">Estado</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('estado', array('readonly'=>true,  'id'=>'estado', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycarmunicipio">Municipio</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('municipio', array('readonly'=>true,  'id'=>'municipio', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	?>



<div class="form-group">
    <label class="control-label col-md-2" for="Mycarmunicipio">Mapa</label>
	<div class="col-md-9">
	 	<div id="map" style="width: 100%; height: 208px"></div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    // get lat long
	    if (navigator.geolocation){
	        navigator.geolocation.getCurrentPosition(function (position) {
	            getStopListingForLocation(position.coords.latitude, position.coords.longitude);
	        });
	    } else {
	        alert('could not get your location');
	    }
	});
</script>
<script type="text/javascript">
    function load__2(position__) {
        if(GBrowserIsCompatible()) {
            var map = new GMap2(document.getElementById("map"));
            map.addControl(new GSmallMapControl());
            map.addControl(new GMapTypeControl());
            var center = new GLatLng(document.getElementById("Mycarlatitud").value , document.getElementById("Mycarlongitud").value);
            map.setCenter(center, 15);
            geocoder = new GClientGeocoder();
            var marker = new GMarker(center, {
                draggable : true
            });
            map.addOverlay(marker);
            document.getElementById("Mycarlatitud").value = center.lat().toFixed(5);
            document.getElementById("Mycarlongitud").value = center.lng().toFixed(5);
            direcciones(center.lat().toFixed(5), center.lng().toFixed(5));
            GEvent.addListener(marker, "dragend", function() {
                var point = marker.getPoint();
                map.panTo(point);
                document.getElementById("Mycarlatitud").value = point.lat().toFixed(5);
                document.getElementById("Mycarlongitud").value = point.lng().toFixed(5);
                direcciones(point.lat().toFixed(5), point.lng().toFixed(5));
            });
            GEvent.addListener(map, "moveend", function() {
                map.clearOverlays();
                var center = map.getCenter();
                var marker = new GMarker(center, {
                    draggable : true
                });
                map.addOverlay(marker);
                document.getElementById("Mycarlatitud").value = center.lat().toFixed(5);
                document.getElementById("Mycarlongitud").value = center.lng().toFixed(5);
                direcciones(center.lat().toFixed(5), center.lng().toFixed(5));
                GEvent.addListener(marker, "dragend", function() {
                    var point = marker.getPoint();
                    map.panTo(point);
                    document.getElementById("Mycarlatitud").value = point.lat().toFixed(5);
                    document.getElementById("Mycarlongitud").value = point.lng().toFixed(5);
                    direcciones(point.lat().toFixed(5), point.lng().toFixed(5));
                });
            });
        }
    }
    function load(){
    	return navigator.geolocation.getCurrentPosition(
	          function (position){
	            coords =  {
	              lng: position.coords.longitude,
	              lat: position.coords.latitude
	            };
	            load__(coords);
	        });
    }
	function load__(position__) {
		if(GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map"));
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
			var center = new GLatLng(position__.lat, position__.lng);
			map.setCenter(center, 15);
			geocoder = new GClientGeocoder();
			var marker = new GMarker(center, {
				draggable : true
			});
			map.addOverlay(marker);
			document.getElementById("Mycarlatitud").value = center.lat().toFixed(5);
			document.getElementById("Mycarlongitud").value = center.lng().toFixed(5);
            direcciones(center.lat().toFixed(5), center.lng().toFixed(5));
			GEvent.addListener(marker, "dragend", function() {
				var point = marker.getPoint();
				map.panTo(point);
				document.getElementById("Mycarlatitud").value = point.lat().toFixed(5);
				document.getElementById("Mycarlongitud").value = point.lng().toFixed(5);
                direcciones(point.lat().toFixed(5), point.lng().toFixed(5));
			});
			GEvent.addListener(map, "moveend", function() {
				map.clearOverlays();
				var center = map.getCenter();
				var marker = new GMarker(center, {
					draggable : true
				});
				map.addOverlay(marker);
				document.getElementById("Mycarlatitud").value = center.lat().toFixed(5);
				document.getElementById("Mycarlongitud").value = center.lng().toFixed(5);
                direcciones(center.lat().toFixed(5), center.lng().toFixed(5));
				GEvent.addListener(marker, "dragend", function() {
					var point = marker.getPoint();
					map.panTo(point);
					document.getElementById("Mycarlatitud").value = point.lat().toFixed(5);
					document.getElementById("Mycarlongitud").value = point.lng().toFixed(5);
                    direcciones(point.lat().toFixed(5), point.lng().toFixed(5));
				});
			});
		}
	}

	function mostrarDireccion() {
		address = jQuery("#address").val();
		var map = new GMap2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		if(geocoder) {
			geocoder.getLatLng(address, function(point) {
				if(!point) {
					alert("No se ha encontrado la dirección: " + address);
				} else {
					document.getElementById("Mycarlatitud").value = point.lat().toFixed(5);
					document.getElementById("Mycarlongitud").value = point.lng().toFixed(5);
                    direcciones(point.lat().toFixed(5), point.lng().toFixed(5));
					map.clearOverlays()
					map.setCenter(point, 14);
					var marker = new GMarker(point, {
						draggable : true
					});
					map.addOverlay(marker);
					GEvent.addListener(marker, "dragend", function() {
						var pt = marker.getPoint();
						map.panTo(pt);
						document.getElementById("Mycarlatitud").value = pt.lat().toFixed(5);
						document.getElementById("Mycarlongitud").value = pt.lng().toFixed(5);
                        direcciones(pt.lat().toFixed(5), pt.lng().toFixed(5));
					});
					GEvent.addListener(map, "moveend", function() {
						map.clearOverlays();
						var center = map.getCenter();
						var marker = new GMarker(center, {
							draggable : true
						});
						map.addOverlay(marker);
						document.getElementById("Mycarlatitud").value = center.lat().toFixed(5);
						document.getElementById("Mycarlongitud").value = center.lng().toFixed(5);
                        direcciones(center.lat().toFixed(5), center.lng().toFixed(5));
						GEvent.addListener(marker, "dragend", function() {
							var pt = marker.getPoint();
							map.panTo(pt);
							document.getElementById("Mycarlatitud").value = pt.lat().toFixed(5);
							document.getElementById("Mycarlongitud").value = pt.lng().toFixed(5);
                            direcciones(pt.lat().toFixed(5), pt.lng().toFixed(5));
						});
					});
				}
			});
		}
	}
    function direcciones(lat, longi, id){
        $.ajax({
            url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+longi+'&key=<?= Configure::read('api_mycarg_google') ?>',
            type:'get',
            data:{},
            success:function(n){
            //echo "$('#pais$id').html(n['results'][0]['address_components']['long_name']);";
            //echo "$('#municipio$id').html(n['results'][4]['formatted_address']);";
            //echo "$('#localidad$id').html(n['results'][0]['address_components'][0]['types']);";
            //alert(n);
            //$('#pais').val( n['results'][0]['address_components'][4]['long_name']); 
            //$('#estado').val(n['results'][0]['address_components'][3]['long_name']);  
            //$('#municipio').val( n['results'][0]['address_components'][1]['long_name']); 
                for(i=0; i<=6 ; i++) { 
                    if (n['results'][0]['address_components'][i]['types'][0] == 'country' ) {                      $('#pais').val( n['results'][0]['address_components'][i]['long_name']); }
                    if (n['results'][0]['address_components'][i]['types'][0] == 'administrative_area_level_1' ) {  $('#estado').val(n['results'][0]['address_components'][i]['long_name']); } 
                    if (n['results'][0]['address_components'][i]['types'][0] == 'locality' ) {                     $('#municipio').val( n['results'][0]['address_components'][i]['long_name']); } 
                }
            }
        });
    }
	load();

</script>




<!--------- Modulos -------->
<div class="form-group">
<label class="control-label col-md-2" for="Mycarmunicipio">Categorias</label>
<div class="col-md-9 col-sm-9 col-xs-9">
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Categorias</h3>
            <div class="box-tools pull-right">
                <button id="newModulosBtn" class="btn btn-box-tool" data-toggle="tooltip" title="Agregar otro modulo" data-widget="chat-pane-toggle"><i class="glyphicon glyphicon-plus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div id="modulos-container">
                <?php $c = 0;foreach($mycarservicios as $mycarservicio){ ?>
                <div id="moduloscount">
                    <div class="form-group tel-con" id="modulo_<?= $c ?>">
                        <label class="control-label col-md-2">Categoria tipo</label>
                        <div class="col-md-3">
                            <select onchange="selectTagRemote('<?= $this->Html->url("/Mycars/categoriasub/".$c) ?>', 'servicio_<?= $c ?>', this.value);" class="form-control tel-<?= $c ?>" id="Modulos_<?= $c ?>__Tipo" name="data[Afiliado][Modulos][<?= $c ?>][tipo]" onchange="Javascript:manageExt(0);">
                            <option value="0">---Seleccione---</option>
                            <?php
                                 foreach($categorias as $categoria){
                                    if($mycarservicio['Mycarservicio']['categoria_id']==$categoria['Categoria']['id']){
                                        echo " <option value=\"".$categoria['Categoria']['id']."\" selected>".$categoria['Categoria']['denominacion']."</option>";
                                    }else{
                                        echo " <option value=\"".$categoria['Categoria']['id']."\">".$categoria['Categoria']['denominacion']."</option>";
                                    }
                                 }
                             ?>
                            </select>
                        </div>
                        <label class="control-label col-md-2">Sub Categoria</label>
                        <div class="col-md-3" id="servicio_<?= $c ?>">
                            <select class="form-control tel-0" id="Modulos_<?= $c ?>__Servicio" name="data[Afiliado][Modulos][<?= $c ?>][servicio]" onchange="Javascript:manageExt(0);">
                            <option value="0">---Seleccione---</option>
                            <?php
                                 foreach($categoriasubs as $categoriasub){
                                    if($mycarservicio['Mycarservicio']['categoria_id']==$categoriasub['Categoriasub']['categoria_id']){
                                        if($mycarservicio['Mycarservicio']['categoriasub_id']==$categoriasub['Categoriasub']['id']){
                                              echo " <option selected value=\"".$categoriasub['Categoriasub']['id']."\">".$categoriasub['Categoriasub']['denominacion']."</option>";
                                        }else{
                                              echo " <option value=\"".$categoriasub['Categoriasub']['id']."\">".$categoriasub['Categoriasub']['denominacion']."</option>";
                                        }
                                    
                                    }
                                 }
                             ?>
                            </select>
                        </div>
                      
                        <div class="col-md-1">
                            <button class="btn btn-danger btn-sm" onclick="if(confirm('Seguro que desea eliminar el registro')){  $('#modulo_<?= $c ?>').remove(); } return false;"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                    </div>
                </div>
                <?php $c++;} ?>

            </div>
        </div>
    </div>
</div>
</div>  
<script type="text/javascript">
$(document).ready(function() {
 
    $("#newModulosBtn").click(function (e) {
        var MaxInputs       = 1000;
        var x = $("#modulos-container #moduloscount").length + 1;
        var FieldCount = x-1;
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            $("#modulos-container").append('<div id="moduloscount">'+
            	                             '<div class="form-group tel-con" id="modulo_'+ FieldCount +'">'+
            	                             '<label class="control-label col-md-2">Categoria</label>'+ 
            	                             '<div class="col-md-3">'+
            	                             '<select onchange="selectTagRemote(\'<?= $this->Html->url("/Mycars/categoriasub/") ?>'+FieldCount+'\', \'servicio_'+FieldCount+'\', this.value);"  class="form-control tel-0" id="Modulos_'+ FieldCount +'__Tipo" name="data[Afiliado][Modulos]['+ FieldCount +'][tipo]" onchange="Javascript:manageExt(0);">'+
	            	                             '<option value="0"></option>'+
                                                 <?php
		            	                             foreach($categorias as $categoria){
		            	                             	echo "  '<option value=\"".$categoria['Categoria']['id']."\">".$categoria['Categoria']['denominacion']."</option>'+   ";
		            	                             }
	            	                             ?>
            	                             '</select>'+
            	                             '</div>'+
                                             '<label class="control-label col-md-2">Sub Categoria</label>'+ 
                                             '<div class="col-md-3" id="servicio_'+ FieldCount +'" >'+
                                             '<select class="form-control tel-0" id="Modulos_'+ FieldCount +'__Servicio" name="data[Afiliado][Modulos]['+ FieldCount +'][servicio]" onchange="Javascript:manageExt(0);">'+
                                             '</select>'+
                                             '</div>'+
            	                             '<div class="col-md-1">'+ 
            	                             '<button class="btn btn-danger btn-sm" onclick="if(confirm(\'Seguro que desea eliminar el registro\')){  $(\'#modulo_'+ FieldCount +'\').remove(); } return false;"><span class="glyphicon glyphicon-trash"></span></button></div></div></div>');
            x++; //text box increment
        }
        return false;
    });
    
});
</script>





<!--------- Modulos -------->
<div class="form-group">
<label class="control-label col-md-2" for="Mycarmunicipio2">Tag</label>
<div class="col-md-9 col-sm-9 col-xs-9">
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Tag</h3>
            <div class="box-tools pull-right">
                <button id="newModulosBtn2" class="btn btn-box-tool" data-toggle="tooltip" title="Agregar otro servicio" data-widget="chat-pane-toggle"><i class="glyphicon glyphicon-plus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div id="modulos-container2">
            <?php $c = 0;foreach($mycartags as $mycartag){ ?>
                <div id="moduloscount2">
                    <div class="form-group tel-con" id="modulo2_<?= $c ?>">
                        <label class="control-label col-md-2">Denominación</label>
                        <div class="col-md-3">
                        <input class="form-control tel-0" value="<?= $mycartag['Mycartag']['denominacion'] ?>" id="Modulos2_<?= $c ?>__Servicio" name="data[Afiliado][Modulos2][<?= $c ?>][denominacion]" onchange="Javascript:manageExt(0);">
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger btn-sm" onclick="return false;"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                    </div>
                </div>
            <?php $c++;} ?>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
 
    $("#newModulosBtn2").click(function (e) {
        var MaxInputs       = 1000;
        var x = $("#modulos-container2 #moduloscount2").length + 1;
        var FieldCount = x-1;
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            $("#modulos-container2").append('<div id="moduloscount2">'+
            	                             '<div class="form-group tel-con" id="modulo2_'+ FieldCount +'">'+
            	                             '<label class="control-label col-md-2">Denominación</label>'+ 
            	                             '<div class="col-md-3">'+
            	                             '<input class="form-control tel-0" id="Modulos2_'+ FieldCount +'__Servicio" name="data[Afiliado][Modulos2]['+ FieldCount +'][denominacion]" onchange="Javascript:manageExt(0);">'+
                                             '</div>'+
            	                             '<div class="col-md-1">'+ 
            	                             '<button class="btn btn-danger btn-sm" onclick="if(confirm(\'Seguro que desea eliminar el registro\')){  $(\'#modulo2_'+ FieldCount +'\').remove(); } return false;"><span class="glyphicon glyphicon-trash"></span></button></div></div></div>');
            x++; //text box increment
        }
        return false;
    });
    
});
</script>



							</div>
							<div class="col-md-12">
								<div class="form-group">
	                                <div class="col-md-12">
	                                    <?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>	                                    <input value="Guardar" class="btn btn-primary pull-right" type="submit">
	                                </div>
	                            </div>
                            </div>
					</div></form>                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
