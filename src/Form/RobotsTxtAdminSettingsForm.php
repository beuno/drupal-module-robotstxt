<?php

namespace Drupal\robotstxt\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure robotstxt settings for this site.
 */
class RobotsTxtAdminSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'robotstxt_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['robotstxt.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('robotstxt.settings');

    $form['robotstxt_content'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Contents of robots.txt'),
      '#default_value' => $config->get('content'),
      '#cols' => 60,
      '#rows' => 20,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('robotstxt.settings');
    $config
      ->set('content', $form_state->getValue('robotstxt_content'))
      ->save();
  }

}
