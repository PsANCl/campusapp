<?php

/**
* @file
* Contains \Drupal\campusapp\Form\SettingsForm.
*/

namespace Drupal\campusapp\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Configure URL and key of campusapp
*/
class SettingsForm extends ConfigFormBase {
	/**
	* {@inheritdoc}
	*/
	public function getFormId() {
		return 'campusapp_settings';
	}
	
	/**
	* {@inheritdoc}
	*/
	protected function getEditableConfigNames() {
		return ['campusapp.settings'];
	}
	
	/**
	* {@inheritdoc}
	*/
	public function buildForm(array $form, FormStateInterface $form_state) {
		$settings=$this->config('campusapp.settings');
		$form=[];
		$form['host']=array(
			'#type'=>'textfield',
			'#title'=>$this->t('Campusapp Server host name'),
			'#default_value' => empty($settings->get('host'))?'':$settings->get('host'),
			'#field_prefix' => 'http://',
			'#field_suffix' => '/api/user',
			'#required' => TRUE,
		);
		$form['apikey']=array(
			'#type' => 'textfield',
			'#title' => $this->t('API Key'),
			'#default_value' => empty($settings->get('apikey'))?'':$settings->get('apikey'),
			'#required' => TRUE,
		);
		$form['apisource']=array(
			'#type' => 'textfield',
			'#title' => $this->t('API Source'),
			'#default_value' => empty($settings->get('apisource'))?'':$settings->get('apisource'),
			'#required' => TRUE,
		);
		return parent::buildForm($form, $form_state);
	}

	/**
	* {@inheritdoc}
	*/
	public function validateForm(array &$form, FormStateInterface $form_state) {
		$url=sprintf('http://%s/api/user/detail', $form_state->getValue('host'));
		$response = \Drupal::httpClient()->get($url);
		if($response->getStatusCode()!='200')
			$form_state->setErrorByName('host', $response->getStatusCode().': '.$response->getReasonPhrase());
	}

	/**
	* {@inheritdoc}
	*/
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config('campusapp.settings')
			->set('host', $form_state->getValue('host'))
			->set('apikey', $form_state->getValue('apikey'))
			->set('apisource', $form_state->getValue('apisource'))
			->save();
		
		parent::submitForm($form, $form_state);
	}
}
?>

