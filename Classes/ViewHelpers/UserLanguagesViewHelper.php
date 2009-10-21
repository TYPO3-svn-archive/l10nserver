<?php

class Tx_L10nServer_ViewHelpers_UserLanguagesViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper {

    protected $selectedValue;

	public function initializeArguments() {
		parent::initializeArguments();

		$this->registerTagAttribute('onChange', 'string', 'JavaScript: onChange action');
        
        $this->setOptions();
        $this->setSelectedValue();
	}

    protected function setOptions() {
        $this->options = array(
            '1' => 'Ukrainian',
            '2' => 'Russian',
            '3' => 'German',
        );
    }

    protected function setSelectedValue() {
        @session_start();
        
        if (intval($_REQUEST['l10nserver']['language'])) {
            $_SESSION['l10nserver']['language'] = $_REQUEST['l10nserver']['language'];
        }

        $this->selectedValue = !empty($_SESSION['l10nserver']['language']) ? 
            $_SESSION['l10nserver']['language'] : '';
    }

    public function render() {
        $this->viewHelperVariableContainer
            ->add('Tx_Fluid_ViewHelpers_FormViewHelper', 'fieldNamePrefix', '');
        $this->viewHelperVariableContainer
            ->add('Tx_Fluid_ViewHelpers_FormViewHelper', 'formFieldNames', '');

        return parent::render();
    }

	protected function getOptions() {
        return $this->options;
    }

	protected function getSelectedValue() {
        return $this->selectedValue;
    }
}
