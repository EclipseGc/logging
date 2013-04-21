<?php
/**
 * Contains \Drupal\logclient\Plugin\Logclient\Connection\Drupal.
 */

namespace Drupal\logclient\Plugin\Logclient\Connection;

use Drupal\Component\Form\FormInterface;
use Drupal\Component\Plugin\PluginBase;
use Drupal\logclient\Plugin\ConnectionInterface;
use Guzzle\Http\Client;

class Drupal extends PluginBase implements FormInterface, ConnectionInterface {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'logclient_connection_drupal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $config = config('logclient.drupal');
    $server = $config->get('server');
    $form['server'] = array(
      '#type' => 'textfield',
      '#title' => t('Server'),
      '#default_value' => $server ? $server : '',
      '#required' => TRUE,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {
    if (!filter_var($form_state['values']['server'], FILTER_VALIDATE_URL)) {
      form_set_error('server', t('The server was not a valid url.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $config = config('logclient.drupal');
    $config->set('server', $form_state['values']['server']);
    $config->save();
  }

  /**
   * {@inheritdoc}
   */
  public function log($type, $message) {
    global $base_url;
    $config = config('logclient.drupal');
    $client = new Client($config->get('server'));
    $request = $client->post('logclient/log/create', NULL, array(
      'type' => $type,
      'message' => $message,
      'site' => $base_url,
    ));
    $data = $request->send()->json();
    drupal_set_message('<pre>' . print_r($data, TRUE) . '</pre>');
  }
}
