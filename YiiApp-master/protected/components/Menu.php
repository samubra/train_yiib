<?php
Yii::import('zii.widgets.CMenu');
class Menu extends CMenu{
	/**
         * Renders the content of a menu item.
         * Note that the container and the sub-menus are not rendered here.
         * @param array $item the menu item to be rendered. Please see {@link items} on what data might be in the item.
         * @return string
         * @since 1.1.6
         */
	public $iconWrapper='span';
        protected function renderMenuItem($item)
        {

                if(isset($item['url']))
                {
        		      $icon=isset($item['icon'])?'<'.$this->iconWrapper.' class="'.$item['icon'].'"></'.$this->iconWrapper.'>':'';
                        $label=$this->linkLabelWrapper===null ? $item['label'] : '<'.$this->linkLabelWrapper.' class="text">'.$item['label'].'</'.$this->linkLabelWrapper.'>';
                       $label=$icon.$label;
                        return CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
                }
                else
                        return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
        }

       
}
