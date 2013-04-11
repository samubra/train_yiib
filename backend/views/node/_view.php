<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('text')); ?>:
	<?php echo GxHtml::encode($data->text); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created')); ?>:
	<?php echo GxHtml::encode($data->created); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('modified')); ?>:
	<?php echo GxHtml::encode($data->modified); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('uid')); ?>:
	<?php echo GxHtml::encode($data->uid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cid')); ?>:
	<?php echo GxHtml::encode($data->cid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('extent')); ?>:
	<?php echo GxHtml::encode($data->extent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parent')); ?>:
	<?php echo GxHtml::encode($data->parent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('itemNum')); ?>:
	<?php echo GxHtml::encode($data->itemNum); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('aloowPublic')); ?>:
	<?php echo GxHtml::encode($data->aloowPublic); ?>
	<br />
	*/ ?>

</div>