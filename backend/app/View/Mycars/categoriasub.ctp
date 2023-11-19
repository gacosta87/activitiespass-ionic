
<select class="form-control tel-0" id="Modulos_<?= $var ?>__Servicio" name="data[Afiliado][Modulos][<?= $var ?>][servicio]" onchange="Javascript:manageExt(0);">
             <option value="0">---Seleccione---</option>
<?php
     foreach($categoriasubs as $categoriasub){
     	echo " <option value=\"".$categoriasub['Categoriasub']['id']."\">".$categoriasub['Categoriasub']['denominacion']."</option>";
     }
 ?>
</select>