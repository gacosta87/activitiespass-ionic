<!--<div id="<?php echo h($key) ?>Message" class="message error"><?php echo h($message) ?></div>-->
<div id="<?php echo h($key) ?>Message" class="alert alert-block alert-danger fade in">
  <button type="button" class="close close-sm" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo h($message) ?>
</div>
