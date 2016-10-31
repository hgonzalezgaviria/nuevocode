<?php
class Vehiculo
{
	private $pdo;
    
    public $id_placa;
    public $modelo;
    public $ano;
    public $id_cedulapro;

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

			$stm = $this->pdo->prepare("select * from vehiculo v
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

	public function ListarPropietarios()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM propietarios");
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
			          ->prepare("SELECT * FROM vehiculo WHERE id_placa = ?");
			          

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
			            ->prepare("DELETE FROM vehiculo WHERE id_placa = ?");			          

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
			$sql = "UPDATE vehiculo SET 
						modelo        	 = ?,
						ano              = ?,
						id_cedulapro	 = ?
				    WHERE id_placa = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->modelo, 
                        $data->ano,
                        $data->id_cedulapro,
                        $data->id_placa
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Vehiculo $data)
	{
		try 
		{
		$sql = "INSERT INTO vehiculo (id_placa,modelo,ano,id_cedulapro) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->id_placa, 
                    $data->modelo,
                    $data->ano,
                    $data->id_cedulapro
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	

}