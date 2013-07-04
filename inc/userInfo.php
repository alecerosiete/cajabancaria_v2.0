<?php


$userData = getUserInfo($user['CI']);
?>
<table class="table table-bordered" style="width: 600px;background: #dfdfdf;border:1px darkgray solid;float:left;">
        <tr >
            <td width="10%" style="text-align:left;font-weight: bold;">Nombre:</td>
            <td width="25%" ><?=$userData[0]['NOMBRE']?></td>
            <td width="10%" style="text-align:left;font-weight: bold;">Apellido:</td>
            <td width="25%" ><?=$userData[0]['APELLIDO']?></td>
        </tr>    
        <tr>
            <td width="10%" style="text-align:left;font-weight: bold;">C.I.: </td>
            <td width="25%"><?=$user['CI']?></td>
            <td width="10%" style="text-align:left;font-weight: bold;">Padron:</td>
            <td width="25%"><?=$user['data']['padron']?></td>
        </tr>

    </table>
