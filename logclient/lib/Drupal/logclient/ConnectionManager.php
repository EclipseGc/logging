<?php

/**
 * Contains \Drupal\logclient\ConnectionManager.
 */

namespace Drupal\logclient;

use Drupal\Component\Plugin\PluginManagerBase;
use Drupal\Component\Plugin\Discovery\DerivativeDiscoveryDecorator;
use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Plugin\Discovery\AnnotatedClassDiscovery;
use Drupal\Core\Plugin\Discovery\AlterDecorator;
use Drupal\Core\Plugin\Discovery\CacheDecorator;

/**
 * A plugin manager for logclient connections.
 *
 * The logclient module exposes a plugin type for configuring a storage server.
 *
 * Class ConnectionManager
 * @package Drupal\logclient
 */
class ConnectionManager extends PluginManagerBase {
  public function __construct($namespaces) {
    $annotation_namespaces = array(
      'Drupal\logclient\Annotation' => $namespaces['Drupal\logclient']
    );
    $this->discovery = new AnnotatedClassDiscovery('Logclient', 'Connection', $namespaces, $annotation_namespaces, 'Drupal\logclient\Annotation\Connection');
    $this->discovery = new DerivativeDiscoveryDecorator($this->discovery);
    $this->discovery = new AlterDecorator($this->discovery);
    $this->factory = new DefaultFactory($this);
  }
}
