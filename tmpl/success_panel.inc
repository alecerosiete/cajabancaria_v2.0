<?php
/*if(hasSuccess()) {
  ?>
<div id="success-panel">

  <h3><?=$_SESSION[S_SUCCESS]?></h3>

</div>

  <?php
  clearSuccess();
}*/
if(hasSuccess()) {
  ?>
<div id="success-panel">
      <?php
      foreach($_SESSION[S_SUCCESS] as $item ) {
        ?>

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Exitoso!</strong></br> <?=$item?>.
            </div>

        <?php
      }
      ?>

</div>

  <?php
  clearSuccess();
}
?>