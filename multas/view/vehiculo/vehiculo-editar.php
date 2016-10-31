    <?php 
        if (!isset($_SESSION)) { session_start(); }
        if(!isset($_SESSION["user"]) && ($_SESSION["rol"] != 0)){
            header('Location: ./?c=login');
        }
    ?>
<h1 class="page-header">
    <?php echo $veh->id_placa != null ? $veh->modelo : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Vehiculo">Vehiculos</a></li>
  <li class="active"><?php echo $veh->id_placa != null ? $veh->modelo : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-Vehiculo" action="?c=Vehiculo&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_placa2" id="id_placa2" value="<?php echo $veh->id_placa; ?>" />
    <input type="hidden" name="cedulapro" id="cedulapro" value="<?php echo $veh->id_cedulapro; ?>" />
    
    <div class="form-group">
        <label>Placa</label>
        <input type="text" name="id_placa" id="placa" value="<?php echo $veh->id_placa; ?>" class="form-control" placeholder="Ingrese placa" data-validacion-tipo="requerido|min:6" />
    </div>

    <div class="form-group">
        <label>Modelo</label>
        <input type="text" name="modelo" value="<?php echo $veh->modelo; ?>" class="form-control" placeholder="Ingrese modelo" data-validacion-tipo="requerido|min:1" />
    </div>
    
    <div class="form-group">
        <label>Año</label>
        <input type="text" name="ano" value="<?php echo $veh->ano; ?>" class="form-control" placeholder="Ingrese año" data-validacion-tipo="requerido|min:4" />
    </div>

    <div class="form-group">
        <label for="sel1">Propietario:</label>
        <select class="form-control" id="id_cedulapro" name="id_cedulapro" data-validacion-tipo="requerido">
                <option value="">Seleccione</option>
                <?php foreach($this->model->ListarPropietarios() as $r): ?>
                <?php  echo "<option value=".$r->id_cedulapro.">".$r->nombre." ".$r->apellido."</option>";  ?>
                <?php endforeach; ?>
        </select>
    </div>

    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){

        $("#frm-Vehiculo").submit(function(){
            return $(this).validate();
        });

        if($('#placa').val().length > 0){           
            $("#id_cedulapro option[value="+ $('#cedulapro').val() +"]").attr("selected",true);
        }

    })
</script>