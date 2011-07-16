<div class="view">
	<?php echo CHtml::link( CHtml::encode($data->title), $this->createUrl('page/view', array( 'title' => $data->title ) ) ); ?>
 (Rev.: <?php echo CHtml::encode($data->revision); ?>)
 <i><?php echo date( 'Y-m-d H:i', CHtml::encode($data->created) ); ?></i>
</div>
