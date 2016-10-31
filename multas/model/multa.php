<?php
class Multa
{
	private $pdo;
    
    public $id_multa;
    public $fecha_multa;
    public $id_placa;
    public $descripcion_multa;
    public $estado_multa;
    public $valor_multa;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("select *
										from multa m
										inner join vehiculo v
										on v.id_placa = m.id_placa
										inner join propietarios p
										on p.id_cedulapro = v.id_cedulapro");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarVehiculos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM vehiculo");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM multa WHERE id_multa = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM multa WHERE id_multa = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE multa SET 
						fecha_multa        	 = ?,
						id_placa             = ?,
						descripcion_multa	 = ?,
						estado_multa		 = ?,
						valor_multa			 = ?
				    WHERE id_multa = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->fecha_multa, 
                        $data->id_placa,
                        $data->descripcion_multa,
                        $data->estado_multa,
                        $data->valor_multa,
                        $data->id_multa
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Multa $data)
	{
		try 
		{
		$sql = "INSERT INTO multa (fecha_multa,id_placa,descripcion_multa,estado_multa,valor_multa) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->fecha_multa, 
                    $data->id_placa,
                    $data->descripcion_multa,
                    $data->estado_multa,
                    $data->valor_multa
                )
			);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	

}