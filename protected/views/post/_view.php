
<h2>
    <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?>
</h2>

<p style="color:#778899"><span class="glyphicon glyphicon-time"></span> Posted on <?php
    $time = CHtml::encode($data->create_time);
    echo date("F j, Y, g:i a", $time);
    ?></p>
<hr>
<?php if($data->image): ?>
<img src="<?php echo '/images/post/'.$data->image ?>" style="margin-left: 12px">
    <hr>
    <?php endif;?>
<p><?php
    if (mb_strlen($data->text) > 400) {
        $data->text = iconv('UTF-8', 'windows-1251', $data->text);
        $data->text = mb_substr(strip_tags($data->text), 0, 397) . '...';
        $data->text = iconv('windows-1251', 'UTF-8', $data->text);
    }
    echo $data->text;
    ?></p>
<a class="btn btn-primary" href="<?php echo 'post/'.$data->id;  ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
<p align ="Right" style="color:#778899">
    <?php
    $count = new Post();
    echo $count->getCountCommentbyPost($data->id);
    ?> Comments</p>
<hr>
