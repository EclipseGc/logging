<?php
/**
 * Contains \Drupal\logclient\Annotation\Connection.
 */

namespace Drupal\logclient\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Connection plugin annotation.
 *
 * Class Connection
 * @package Drupal\logclient\Annotation
 */
class Connection extends Plugin {

  /**
   * The label of the plugin.
   */
  public $label;

  /**
   * The name of the connection class.
   *
   * This is not provided manually, it will be added by the discovery mechanism.
   *
   * @var string
   */
  public $class;

}
