<?php
		class atl_clients
		{
			private $id;
			private $firstName;
			private $lastName; 
			private $status; 

            var $telephone;
			
            public function __set($key, $value){
                $this->$key = $value;
            }
        
            public function __get($key){
                return $this->$key;
            }
            
			function __construct($id=0)
			{
				if($id > 0)
				{
					$this->id = $id;
					$this->cargar();
				}
			}

			function guardar()
			{
				$rs = true;
				global $con;
				if($this->id > 0)
				{
					$sql = "update atl_clients set first_name = '$this->firstName',last_name = '$this->lastName',
                    status = '$this->status' 
					where id = '$this->id'";
					Consulting::query($sql);
					echo ('Datos Actualizados Correctamente');
				}
				else
				{
					$sql = "insert into atl_clients 
					(first_name,last_name,status) 
					values
					('$this->firstName','$this->lastName',1)
					";
					Consulting::query($sql);
                    echo mysqli_error(Consulting::getCon());
					$this->id = mysqli_insert_id(Consulting::getCon());
				    echo ('Datos Insertados Correctamente');
				}
				$this->saveTelephone();
				return $rs;
			}
			
			function cargar()
			{
				$sql             = "select * from atl_clients where id = '$this->id'";
				$result          = Consulting::query($sql);
				$row             = mysqli_fetch_array($result);
				$this->id        = $row['id'];
                $this->firstName = $row['first_name'];
                $this->lastName  = $row['last_name'];
                $this->status    = $row['status'];
               
			}
			
            function showListData(){
                $sql             = "select * from atl_clients";
				$result           = Consulting::query($sql);
				
                return $result;
		    }

            function showListTelephone(){
                $sql             = "select * from atl_client_telephone where id_client = '$this->id' and `status`=1";
				$result           = Consulting::query($sql);
				
                return $result;
		    }

            function showListAddress($data = ""){
                if($data!=""){
                    $data = "and id='$data'";
                }
                $sql             = "select * from atl_client_address where id_client = '$this->id' $data and `status`=1";
				$result           = Consulting::query($sql);
				
                return $result;
		    }

            function saveTelephone(){
                $sql     = "update atl_client_telephone set status = 0  where id_client = '$this->id'";
				$result  = Consulting::query($sql);

                foreach ($this->telephone as $key => $telephone) {
                   $sql = "insert into atl_client_telephone (id_client,`number`) values ('$this->id','$telephone')";
                   $result  = Consulting::query($sql);
                }
            }

    }
?>