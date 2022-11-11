<?php
    require_once("./class/groupclass.php");
    $client = new atl_clients();
    
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
?>