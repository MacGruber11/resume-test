<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('comment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Comments</h1>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'comment-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'content',
        array(            
            'name'=>'create_time',
            'value'=>'date("Y-m-d H:i:s", $data->create_time)',
        ),
        array(            
            'name'=>'author_id',
            'value'=>'$data->getAuthor($data->author_id)',
        ),
        array(            
            'name'=>'post_id',
            'value'=>'$data->getPostTitle($data->post_id)',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
        ),
    ),
));
?>
