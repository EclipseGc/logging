<?php
/**
 * Contains \Drupal\logclient\LogclientSettings.
 */

namespace Drupal\logclient;

use Drupal\Core\Form\FormInterface;

class LogclientSettings implements FormInterface {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'logclient_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $plugins = array();
    foreach (\Drupal::service('plugin.manager.logclient.connection')->getDefinitions() as $plugin_id => $definition) {
      $plugins[$plugin_id] = $definition['label'];
    }
    $form['connection'] = array(
      '#type' => 'select',
      '#required' => TRUE,
      '#title' => t('Connection Type'),
      '#options' => $plugins,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {}
}