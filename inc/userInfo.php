<?php


$userData = getUserInfo($user['CI']);
?>
<table class="table table-bordered" style="width: 550px;float:left;">
        <tr>
            <td width="25%" style="text-align:right;font-weight: bold">Nombre:</td>
            <td width="25%" ><?=$userData[0]['NOMBRE']?></td>
            <td width="25%" style="text-align:right;font-weight: bold">Apellido:</td>
            <td width="25%" ><?=$userData[0]['APELLIDO']?></td>
        </tr>    
        <tr>
            <td width="25%" style="text-align:right;font-weight: bold">C.I.: </td>
            <td width="25%"><?=$user['CI']?></td>
            <td width="25%" style="text-align:right;font-weight: bold">Padron:</td>
            <td width="25%"><?=$user['data']['padron']?></td>
        </tr>

    </table>
