    <?php 
        if (!isset($_SESSION)) { session_start(); }
        if(!isset($_SESSION["user"]) && ($_SESSION["rol"] != 0)){
            header('Location: ./?c=login');
        }
    ?>
<h1 class="page-header">Vehiculos</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Vehiculo&a=Crud">Nuevo Vehiculo</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Placa</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Propietario</th>
            <th>Nombre Propietario</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->id_placa; ?></td>
            <td><?php echo $r->modelo; ?></td>
            <td><?php echo $r->ano; ?></td>
            <td><?php echo $r->id_cedulapro; ?></td>
            <td><?php echo $r->nombre." ".$r->apellido; ?></td>
            <td>
                <a href="?c=Vehiculo&a=Crud&id_placa=<?php echo $r->id_placa; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Vehiculo&a=Eliminar&id_placa=<?php echo $r->id_placa; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
