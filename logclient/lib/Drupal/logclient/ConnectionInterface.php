<?php
/**
 * Contains \Drupal\logclient\ConnectionInterface.
 */

namespace Drupal\logclient;

/**
 * An interface for logclient Connection plugins.
 *
 * Interface ConnectionInterface
 * @package Drupal\logclient
 */
interface ConnectionInterface {

  /**
   * Logs messages of a particular type to a log server.
   *
   * @param string $type
   *   The type of message being logged.
   * @param string $message
   *   The message to be logged.
   *
   * @return NULL
   */
  public function log($type, $message);

}