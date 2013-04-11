<?php
Yii::import('ext.multimodelform.MultiModelForm');
/**
 * The CForm to render the input form
 */
class MultiModelRenderBootstrapForm extends MultiModelRenderForm
{

    /**
     * Modified for bootstrapLayout
     */
    public function renderButtons()
    {
        if ($this->parentWidget->bootstrapLayout)
        {
            $output = '';
            foreach ($this->getButtons() as $button)
                $output .= $this->renderElement($button);
            return $output !== '' ? "<div class=\"form-actions\">" . $output . "</div>\n" : '';
        } else
            parent::renderButtons();
    }

    /**
     * Modified for bootstrapLayout
     */
    public function renderElement($element)
    {
        if ($this->parentWidget->bootstrapLayout) //begin bootstrapLayout
        {
            if (is_string($element))
            {
                if (($e = $this[$element]) === null && ($e = $this->getButtons()->itemAt($element)) === null)
                    return $element;
                else
                    $element = $e;
            }
            if ($element->getVisible())
            {
                if ($element instanceof CFormInputElement)
                {
                    if ($element->type === 'hidden')
                        return "<div style=\"display:none\">\n" . $element->render() . "</div>\n";
                    else
                        return "<div class=\"controls field_{$element->name}\">\n" . $element->render() . "</div>\n";
                } else if ($element instanceof CFormButtonElement)
                    return $element->render() . "\n";
                else
                    return $element->render();
            }
            return '';
        } //end bootstrapLayout
        else
            parent::renderElement($element);
    }

    /**
     * Wraps a content with row wrapper
     *
     * @param string $content
     * @return string
     */
    protected function getWrappedRow($content)
    {
        return CHtml::tag($this->parentWidget->rowWrapper['tag'],
            $this->parentWidget->rowWrapper['htmlOptions'], $content);
    }

    /**
     * Wraps a content with fieldset wrapper
     *
     * @param string $content
     * @return string
     */
    protected function getWrappedFieldset($content)
    {
        $htmlOptions = $this->parentWidget->fieldsetWrapper['htmlOptions'];

        if ($this->isCopyTemplate)
        {
            $htmlOptions['id'] = $this->parentWidget->getCopyFieldsetId();
            if ($this->parentWidget->hideCopyTemplate)
                $htmlOptions['style'] = !empty($htmlOptions['style']) ? $htmlOptions['style'] . ' display:none;' : 'display:none;';
        }

        return CHtml::tag($this->parentWidget->fieldsetWrapper['tag'], $htmlOptions, $content);
    }

    /**
     * Returns the generated label from Yii form builder
     * Needs to be replaced by the real attributeLabel
     * @see method  renderFormElements()
     *
     * @param string $prefix
     * @param string $attributeName
     * @return string
     */
    protected function getAutoCreatedLabel($prefix, $attributeName)
    {
        return ($this->model->generateAttributeLabel('[' . $prefix . '][' . $this->index . ']' . $attributeName));
    }

    /**
     * Renders the table head
     *
     * @return string
     */
    public function renderTableHeader()
    {
        $cells = '';

        foreach ($this->getElements() as $element)
        {
            if ($element->visible && isset($element->type) && $element->type != 'hidden') //bugfix v3.1
            {
                $text = empty($element->label) ? '&nbsp;' : $element->label;
                $options = array();

                if ($element->getRequired())
                {
                    $options = array('class' => CHtml::$requiredCss);
                    $text .= CHtml::$afterRequiredLabel;
                }

                $cells .= CHtml::tag('th', $options, $text);
            }
        }

        if (!empty($cells))
        {
            //add an empty column instead of remove link
            $cells .= CHtml::tag('th', array(), '&nbsp');

            $row = $this->getWrappedFieldset($cells);
            echo CHtml::tag('thead', array(), $cells);
        }

    }


    /**
     * Check if elem is a array type
     *
     * @param string $type
     * @return boolean
     */
    protected function isElementArrayType($type)
    {
        switch ($type)
        {
            case 'checkboxlist':
            case 'radiolist':
                return true;
            default:
                return false;
        } // switch
    }

    /**
     * Renders the label for this input.
     * The default implementation returns the result of {@link CHtml activeLabelEx}.
     * @return string the rendering result
     */
    public function renderElementLabel($element, $htmlOptions = array())
    {
        $class = '';

        $options = array_merge($htmlOptions, array(
            'label' => $element->getLabel(),
            'required' => $element->getRequired()
        ));

        if ($this->parentWidget->bootstrapLayout)
        {

            switch ($element->type)
            {
                case 'checkbox':
                case 'checkboxlist':
                    $class = 'checkbox';

                case 'radio':
                case 'radiolist':
                    $class = 'radio';

                default:
                    $class = 'control-label';
            }
        }

        if (!empty($class))
            $options['class'] = $class;

        if (!empty($element->attributes['id']))
        {
            $options['for'] = $element->attributes['id'];
        }

        return CHtml::activeLabel($element->getParent()->getModel(), $element->name, $options);
    }

    /**
     * Renders a single form element
     * Remove the '[]' from the label
     *
     * @return string
     */
    protected function renderFormElements()
    {
        $output = '';

        $elements = $this->getElements();

        foreach ($elements as $element)
        {
            if (isset($element->name)) //element is an attribute of the model
            {
                $elemName = $element->name;

                if ($this->parentWidget->bootstrapLayout && !$this->parentWidget->tableView)
                    $element->layout = "{label}<div class=\"controls\">{input}\n{hint}\n{error}</div>";

                $elemLabel = $this->parentWidget->tableView ? '' : $this->renderElementLabel($element);
                $replaceLabel = array('{label}' => $elemLabel);
                $element->label = false; //no label on $element->render()
                $element->layout = strtr($element->layout, $replaceLabel);

                $doRender = false;
                if ($this->isCopyTemplate && $element->visible) // new fieldset
                {
                    //Array types have to be rendered as array in the CopyTemplate
                    $element->name = $this->isElementArrayType($element->type) ? $elemName . '[][]' : $elemName . '[]';
                    $doRender = true;
                } elseif (!empty($this->primaryKey))
                { // existing fieldsets update

                    $prefix = 'u__';
                    $element->name = '[' . $prefix . '][' . $this->index . ']' . $elemName;
                    $doRender = true;
                } else
                { //in validation error mode: the new added items before
                    if ($element->visible)
                    {
                        $prefix = 'n__';
                        $element->name = '[' . $prefix . '][' . $this->index . ']' . $elemName;
                        $doRender = true;
                    }
                }

                if ($doRender)
                {
                    $elemOutput = $element->render();
                    $output .= $element->type == 'hidden' ? $elemOutput : $this->getWrappedRow($elemOutput);
                }
            } else //CFormStringElement...
                $output .= $element->render();
        }

        $output .= $this->parentWidget->getRemoveLink($this->isCopyTemplate);

        return $output;
    }

    /**
     * Renders the primary key value as hidden field
     * Need determine which records to delete
     *
     * @param string $classSuffix
     * @return string
     */
    public function renderHiddenPk($classSuffix = '[pk__]')
    {
        $output = '';
        foreach ($this->primaryKey as $key => $value)
        {
            $modelClass = get_class($this->parentWidget->model);
            $name = $modelClass . $classSuffix . '[' . $this->index . ']' . '[' . $key . ']';
            $output .= CHtml::hiddenField($name, $value);
        }

        return $output;
    }

    /**
     * Get the add item link or button
     *
     * @return string
     */
    public function getAddLink()
    {
        if ($this->parentWidget->addItemAsButton)
        {
            echo CHtml::htmlButton($this->parentWidget->addItemText,
                array('id' => $this->parentWidget->id,
                    'rel' => '.' . $this->parentWidget->getCopyClass()
                ));
        } else
        {
            return CHtml::tag('a',
                array('id' => $this->parentWidget->id,
                    'href' => '#',
                    'rel' => '.' . $this->parentWidget->getCopyClass()
                ),
                $this->parentWidget->addItemText
            );
        }
    }

    /**
     * Renders the link 'Add' for cloning the DOM element
     *
     * @return string
     */
    public function renderAddLink()
    {
        $tag = $this->parentWidget->rowWrapper['tag'];
        $htmlOptions = $this->parentWidget->rowWrapper['htmlOptions'];

        $htmlOptions['class'] = !empty($htmlOptions['class']) ? $htmlOptions['class'] . ' mmf_additem' : 'mmf_additem';

        return CHtml::tag($tag, $htmlOptions, $this->getAddLink());
    }

    /**
     * Renders the CForm
     * Each fieldset is wrapped with the fieldsetWrapper
     *
     * @return string
     */
    public function render()
    {
        $elemOutput = $this->renderBegin();
        $elemOutput .= $this->renderFormElements();
        $elemOutput .= $this->renderEnd();
        // wrap $elemOutput
        $wrapperClass = $this->parentWidget->fieldsetWrapper['htmlOptions']['class'];

        if ($this->isCopyTemplate)
        {
            $class = empty($wrapperClass)
                ? $this->parentWidget->getCopyClass()
                : $wrapperClass . ' ' . $this->parentWidget->getCopyClass();
        } else
            $class = $wrapperClass;

        $this->parentWidget->fieldsetWrapper['htmlOptions']['class'] = $class;
        return $this->getWrappedFieldset($elemOutput);
    }
}