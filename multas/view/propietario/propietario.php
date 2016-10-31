	<?php 
		if (!isset($_SESSION)) { session_start(); }
		if(!isset($_SESSION["user"]) && ($_SESSION["rol"] != 0)){
			header('Location: ./?c=login');
		}
	?>
<h1 class="page-header">Propietarios</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Propietario&a=Crud">Nuevo propietario</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Identificación</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->id_cedulapro; ?></td>
            <td><?php echo $r->nombre; ?></td>
            <td><?php echo $r->apellido; ?></td>
            <td>
                <a href="?c=Propietario&a=Crud&id_cedulapro=<?php echo $r->id_cedulapro; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Propietario&a=Eliminar&id_cedulapro=<?php echo $r->id_cedulapro; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
