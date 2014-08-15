<div class="media">
    <div class="media-body">
        <h4 class="media-heading"><a href="<?php echo Yii::app()->homeUrl.'user/user/view?id='.$data->author_id; ?>">
                <?php echo CHtml::encode($data->getAuthor($data->author_id)); ?></a>
            <small><?php
                $time = CHtml::encode($data->create_time);
                ;
                echo date("F j, Y, g:i a", $time);
                ?></small>
        </h4>
        <?php echo CHtml::encode($data->content); ?>
    </div>
</div>