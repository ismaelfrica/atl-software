<?php
    require_once("./class/groupclass.php");
    $client = new atl_clients();
    
    switch ($_GET['origin']) {
        case 'home':
            $data         = $client->showListData();
            $count        = 0;
            
            while($row    = mysqli_Fetch_array($data)){

                $count++;
                $name     = $row['first_name'];
                $lastName = $row['last_name'];
                $id       = $row['id'];
                echo <<<Client
                <tr>
                    <td>$count</td>
                    <td>$name</td>
                    <td>$lastName</td>
                    <td><a href='javascript:void' data-id="$id" class="btn btn-info" onclick='obtaingData(this)' data-action='editar'>Ver</a></td>
                </tr>
                Client;

            }
        break;

        case 'Adress':
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
        break;
        
        default:
            # code...
            break;
    }
    
?>