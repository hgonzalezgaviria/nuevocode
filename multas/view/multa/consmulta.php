	<?php 
		if (!isset($_SESSION)) { session_start(); }
		if(!isset($_SESSION["user"])){
			header('Location: ./?c=login');
		}
	?>
<h1 class="page-header">Multas Por Vehiculo Y Propietario</h1>



<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Multa</th>
            <th>Fecha Multa</th>
            <th>Propietario</th>
            <th>Placa</th>
            <th>Descripcion</th>
            <th>Estado Multa</th>
            <th>Valor Multa</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->id_multa; ?></td>
            <td><?php echo $r->fecha_multa; ?></td>
            <td><?php echo substr($r->nombre." ".$r->apellido, 0,20); ?></td>
            <td><?php echo $r->id_placa; ?></td>
            <td><?php echo $r->descripcion_multa; ?></td>
            <td>
            <?php
            $val = $r->estado_multa;
            $desc = "";
            if($val == 1){
                $desc = "Pendiente de Pago";
            }else if($val == 2){
                $desc = "Pagada";
            }else if($val == 3){
                $desc = "Preescrita";
            }
            echo $desc; 
            ?>
            </td>
            <td><?php echo $r->valor_multa; ?></td>
            
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
