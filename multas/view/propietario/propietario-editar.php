    <?php 
        if (!isset($_SESSION)) { session_start(); }
        if(!isset($_SESSION["user"]) && ($_SESSION["rol"] != 0)){
            header('Location: ./?c=login');
        }
    ?>
<h1 class="page-header">
    <?php echo $pro->id_cedulapro != null ? $pro->nombre : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Propietario">Propietarios</a></li>
  <li class="active"><?php echo $pro->id_cedulapro != null ? $pro->nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-propietario" action="?c=Propietario&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_cedulapro" value="<?php echo $pro->id_cedulapro; ?>" />
    
    <div class="form-group">
        <label>Identificación</label>
        <input type="text" name="id_cedulapro" value="<?php echo $pro->id_cedulapro; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="form-group">
        <label>Nombres</label>
        <input type="text" name="nombre" value="<?php echo $pro->nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Apellidos</label>
        <input type="text" name="apellido" value="<?php echo $pro->apellido; ?>" class="form-control" placeholder="Ingrese su apellido" data-validacion-tipo="requerido|min:10" />
    </div>

    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-propietario").submit(function(){
            return $(this).validate();
        });
    })
</script>