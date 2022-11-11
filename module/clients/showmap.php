<?php
    include("../../class/groupclass.php");
    $client = new atl_clients();

    if(isset($_GET['idClient']))
    {
        $client->id = $_GET['idClient'] + 0;
        $client->cargar();
        
    }

    $data = mysqli_fetch_array($client->showListAddress($_GET['id'],$client->id));

?>
<style>iframe {width:100%;height:100%;}</style>

<div class="mapouter">
    <div class="gmap_canvas">
        <iframe width="600" 
                height="500" 
                id="gmap_canvas" 
                src="https://maps.google.com/maps?q=<?= $data['address'];?>&t=&z=13&ie=UTF8&iwloc=&output=embed" '
                frameborder="0" 
                scrolling="no" 
                marginheight="0" 
                marginwidth="0">
        </iframe>
                <style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style>
                <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
    </div>
</div>