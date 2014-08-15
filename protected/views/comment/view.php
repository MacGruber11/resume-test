
<h1>View Comment #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
		'create_time',
		'author_id',
		'post_id',
	),
)); ?>
