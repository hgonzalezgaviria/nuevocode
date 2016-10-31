    <?php 
        if (!isset($_SESSION)) { session_start(); }
        if(!isset($_SESSION["user"]) && ($_SESSION["rol"] != 0)){
            header('Location: ./?c=login');
        }
    ?>
<h1 class="page-header">
    <?php echo $mul->id_placa != null ? "Multa No. ".$mul->id_multa." ".$mul->descripcion_multa : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Multa">Multas</a></li>
  <li class="active"><?php echo $mul->id_multa != null ? $mul->id_placa : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-multa" action="?c=Multa&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_multa2" id="id_multa2" value="<?php echo $mul->id_multa; ?>" />
    <input type="hidden" name="id_placa2" id="id_placa2" value="<?php echo $mul->id_placa; ?>" />
    <input type="hidden" name="estadom" id="estadom" value="<?php echo $mul->estado_multa; ?>" />
    
    <div class="form-group">
        <label>Multa</label>
        <input type="text" name="id_multa" id="id_multa" value="<?php echo $mul->id_multa; ?>" class="form-control" placeholder="" disabled />
    </div>

    <div class="form-group">
        <label>Fecha Multa</label>
        <input type="date" name="fecha_multa" value="<?php echo $mul->fecha_multa; ?>" class="form-control" placeholder="Ingrese Fecha de Multa" data-validacion-tipo="requerido|min:1" />
    </div>

     <div class="form-group">
        <label for="sel1">Vehiculo:</label>
        <select class="form-control" id="id_placa" name="id_placa" data-validacion-tipo="requerido">
                <option value="">Seleccione</option>
                <?php foreach($this->model->ListarVehiculos() as $r): ?>
                <?php  echo "<option value=".$r->id_placa.">".$r->modelo." ".$r->ano."</option>";  ?>
                <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Descripción</label>
        <input type="text" name="descripcion_multa" value="<?php echo $mul->descripcion_multa; ?>" class="form-control" placeholder="Ingrese Descripción" data-validacion-tipo="requerido|min:1" />
    </div>
    
    <div class="form-group">
        <label for="sel1">Estado Multa:</label>
        <select class="form-control" id="estado_multa" name="estado_multa" data-validacion-tipo="requerido">
                <option value="">Seleccione</option>
                <option value="1">Pendiente de Pago</option>
                <option value="2">Pagada</option>
                <option value="3">Preescrita</option>
        </select>
    </div>

    <div class="form-group">
        <label>Valor</label>
        <input type="number" name="valor_multa" value="<?php echo $mul->valor_multa; ?>" class="form-control" placeholder="Ingrese Valor de Multa" data-validacion-tipo="requerido|min:4" />
        </textarea>
    </div>

    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){

        $("#frm-multa").submit(function(){
            return $(this).validate();
        });

        if($('#id_multa').val().length > 0){        
            $("#id_placa option[value="+ $('#id_placa2').val() +"]").attr("selected",true);
            $("#estado_multa option[value="+ $('#estadom').val() +"]").attr("selected",true);
        }

    })
</script>