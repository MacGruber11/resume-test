<?php
if (Yii::app()->getModule('user')->isAdmin()) {
    $this->menu = array(
        array('label' => 'Manage Post', 'url' => array('admin')),
    );
}
?>


<div class="col-lg-3">
    <h1><?php echo $model->title; ?></h1>
    <hr>
    
    
    <p style="color:#778899"><span class="glyphicon glyphicon-time"></span> Posted on <?php
        $time = $model->create_time;
        echo date("F j, Y, g:i a", $time);
        ?></p>
    <hr>
    <?php if($model->image): ?>
    <img src="<?php echo '/images/post/'.$model->image ?>" style="margin-left: 12px">
    <hr>
    <?php endif;?>
    <?php echo $model->text; ?>
    <hr>   
    <?php if (!Yii::app()->user->isGuest): ?>

        <div>
            <h4>Leave a Comment:</h4>
            <?php
            $this->renderPartial('/comment/_form', array(
                'model' => $comment,
            ));
            ?>
        </div>
        <hr>
    <?php else: ?> 
        <p style="color:#778899"><a href="<?php echo Yii::app()->homeUrl.'user/login' ?>">Login</a> or <a href="<?php echo Yii::app()->homeUrl.'user/registration' ?>">Register</a> to leave a comment that</p>
    <?php endif; ?>
    <?php
    $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider' => $comment->getCommentById($model->id),
        'itemView' => '/comment/_view',
    ));
    ?>
</div>




