
<?php
if (Yii::app()->getModule('user')->isAdmin()) {
    $this->menu = array(
        array('label' => 'Create Post', 'url' => array('create')),
        array('label' => 'Manage Post', 'url' => array('admin')),
    );
}
?>

<h1 style="padding-left: 300px">Posts</h1>

<?php $post = new Post();
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $post->getAllPost(),
    'itemView' => '_view',
));
?>
