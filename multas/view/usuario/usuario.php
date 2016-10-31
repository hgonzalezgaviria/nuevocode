    <?php 
        if (!isset($_SESSION)) { session_start(); }
        if(!isset($_SESSION["user"]) && ($_SESSION["rol"] != 0)){
            header('Location: ./?c=login');
        }
    ?>
<h1 class="page-header">Usuarios</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Usuario&a=Crud">Nuevo Usuario</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Id Usuario</th>
            <th>Usuario</th>
            <th>Password</th>
            <th>Tipo Usuario</th>
            <th>Nombre Usuario</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->id_usuario; ?></td>
            <td><?php echo $r->nombre; ?></td>
            <td><?php echo $r->password; ?></td>
            <td><?php echo $r->tipo_usuario; ?></td>
            <td><?php echo $r->id_propietario; ?></td>
            <td>
                <a href="?c=Usuario&a=Crud&id_usuario=<?php echo $r->id_usuario; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Usuario&a=Eliminar&id_usuario=<?php echo $r->id_usuario; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
