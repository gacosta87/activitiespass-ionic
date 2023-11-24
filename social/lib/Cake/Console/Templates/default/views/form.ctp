<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<section class="content-header">
  <h1>
    <?php echo "<?= Configure::read('namesysS'); ?>"; ?>
    <small><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo "<?= \$this->Html->url('/Dashboard/')?>"; ?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo "<?php echo \$this->Form->create('{$modelClass}', array('class'=>'form-horizontal')); ?>\n"; ?>
					<?php
					 echo "<div class='row'>\n";
					?>
							<?php
							 echo "<div class='col-md-12'>\n";
							?>
							<?php   
									echo "\t<?php\n";
									foreach ($fields as $field) {
										
										if (strpos($action, 'add') !== false && $field === $primaryKey) {
											continue;
										} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
											if($field=="id"){
												echo "\t\t\t\necho \$this->Form->input('{$field}', array('class'=>'form-horizontal'));";
											}else{
												echo "\t\necho'<div class=\"form-group\">';";
												$id = $modelClass.$field;
												echo "\t\necho'<label class=\"control-label col-md-2\" for=\"{$id}\">{$field}</label>';";
													echo "\t\t\necho'<div class=\"col-md-9\">';";
														echo "\t\t\t\necho \$this->Form->input('{$field}', array('id'=>'{$id}', 'div'=>false, 'label'=>false, 'class'=>'form-control'));";
													echo "\t\t\necho '</div>';";
												echo "\t\necho '</div>';\n";
											}
										}
									}
									if (!empty($associations['hasAndBelongsToMany'])) {
										foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
											echo "\t\necho'<div class=\"form-group\">';";
											$id = $modelClass.$assocName;
											echo "\t\necho'<label class=\"control-label col-md-2\" for=\"{$assocName}\">>{$assocName}</label>';";
												echo "\t\t\necho'<div class=\"col-md-9\">';";
													echo "\t\t\t\necho \$this->Form->input('{$assocName}', array('id'=>'{$id}', 'div'=>false, 'label'=>false, 'class'=>'form-control'));";
												echo "\t\t\necho '</div>';";
											echo "\t\necho '</div>';\n";
										}
									}
									echo "\t?>\n";
							?>
							<?php
							 echo "</div>\n";
							 ?>
							<div class="col-md-12">
								<div class="form-group">
	                                <div class="col-md-12">
	                                    <?php echo "<?php echo \$this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>"; ?>
	                                    <input value="Guardar" class="btn btn-primary pull-right" type="submit">
	                                </div>
	                            </div>
                            </div>
					<?php
					 echo "</div>";
					 echo "</form>";
					?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<?php echo "<?php /* ?>"; ?>
	<div class="actions">
		<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
		<ul>
	<?php if (strpos($action, 'add') === false): ?>
			<li><?php echo "<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array(), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
	<?php endif; ?>
			<li><?php echo "<?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?>"; ?></li>
	<?php
			$done = array();
			foreach ($associations as $type => $data) {
				foreach ($data as $alias => $details) {
					if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
						echo "\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
						echo "\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
						$done[] = $details['controller'];
					}
				}
			}
	?>
		</ul>
	</div>
<?php echo "<?php */ ?>"; ?>