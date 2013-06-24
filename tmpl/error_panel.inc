<?php
if(hasErrors()) {
?>
<div id="error-panel" style="z-index: 2;">

      <?php
      foreach($_SESSION[S_ERROR_LIST] as $item ) {
      ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong></br> <?=$item?>.
            </div>
      <?php
      }
      ?>

</div>

<?php
  clearErrors();
}
?>

