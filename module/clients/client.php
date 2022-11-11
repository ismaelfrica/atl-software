<?php
    include("../../class/groupclass.php");
    $client = new atl_clients();

    if($_POST)
    {
        $client->id        = (isset($_POST['txtId']))?$_POST['txtId']:$client->id;
        $client->firstName = (isset($_POST['txtName']))?$_POST['txtName']:$client->firstName;
        $client->lastName  = (isset($_POST['txtLastName']))?$_POST['txtLastName']:$client->lastName;
        
        $client->telephone = empty($_POST['txtTelephone']) ? [] : $_POST['txtTelephone'];
        $client->address   = empty($_POST['txtAdress']) ? [] : $_POST['txtAdress'];

        

        $client->guardar();
        exit();
    }else{
        if(isset($_GET['id']))
        {
            $client->id = $_GET['id'];
            $client->cargar();
            
        }
    }
?>

<div class="container">
    <form method="POST" id="formCLient" action="module/clients/client.php">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="mb-3 row">
                    <input type="hidden" id="txtId" name="txtId" value="<?= $client->id;?>"
                    <label for="txtName" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="txtName" name="txtName" value="<?= $client->firstName;?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="mb-3 row">
                    <label for="txtLastName"  class="col-sm-2 col-form-label">Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="txtLastName" name="txtLastName" value="<?= $client->lastName;?>">
                    </div>
                </div>
            </div>
            <div class="margin_20">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="text-center">
                            <a href="javascript:void" class='btn btn-primary'data-action='Telephone' onclick="addRow(this)" id='createTelephone'>Crear Tel&eacute;fonos</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Tel&eacute;fono</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="Telephone">
                                <?php
                                    $data         = $client->showListTelephone();
                                    $count        = 0;
                                    while($row    = mysqli_Fetch_array($data)){

                                        $count++;
                                        $telephone     = $row['number'];

                                        echo <<<Client
                                            <tr>
                                                <td><a href='tel:$telephone'>$telephone</a>
                                                <input type="hidden" name="txtTelephone[]" id="txtTelephone$count" class='form-control'  value="$telephone">
                                                
                                                </td>
                                                <td><a href='javascript:void' class="btn btn-danger" data-action='eliminar' onclick='deleteRow(this)'><i class='fa fa-trash'></i></a></td>
                                            </tr>
                                        Client;

                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="text-center">
                            <a href="javascript:void" class='btn btn-primary'data-action='Adress'  onclick="addRow(this)" >Crear Direcci&oacute;n</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Direcci&oacute;n</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="Adress">
                                <?php
                                    $data         = $client->showListAddress();
                                     $count        = 0;
                                    while($row    = mysqli_Fetch_array($data)){

                                        $count++;
                                        $address     = $row['address'];
                                        $id          = $row['id'];

                                        echo <<<Client
                                            <tr>
                                                <td><input type="text" name="txtAdress[]" id="txtAddress$count" class='form-control' required value="$address"></td>
                                                
                                                <td><a href='javascript:void' class="btn btn-danger" data-action='eliminar' onclick='deleteRow(this)'><i class='fa fa-trash'></i></a>
                                                    <a href='javascript:void' class="btn btn-info" data-id='$id' data-client-id='$client->id' onclick="viewMap(this)" data-action='verMapa'><i class='fa fa-map'></i></a>
                                                </td>
                                            </tr>
                                        Client;

                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12" 
                     id="divClientResult">
                </div>
                <div class="col-12 text-center">
                        <button type='submit' id='btnSave' title ='Cobrar' class='btn btn-success' >Guardar</button>
						<button type='button' class='btn btn-danger' data-bs-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    formsubmit($('#formCLient'), $('#divClientResult'));
</script>