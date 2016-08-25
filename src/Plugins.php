<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * Command that installs the site plugins.
 *
 * ## EXAMPLE
 *
 *     # Install the site plugins
 *     $ wp profile-install plugins example/plugins.yml
 *     Success: Plugins installed successfully.
 *
 */
class Plugins extends Installer {

  /**
   * @var array $data_structure the file data structure.
   */
  protected $data_structure = array (
    'allowed_properties' => array(),
    'required_properties' => array(),
  );

  /**
   * Install a WordPress site plugins from a config Yaml file.
   *
   * ## OPTIONS
   *
   * <config-file>
   * : The config file relative path.
   *
   * ## EXAMPLES
   *
   * wp profile-install plugins example/plugins.yml
   *
   */
  public function __invoke( $args, $assoc_args ) {
    parent::__invoke( $args, $assoc_args );
  }

  /**
   * Install process for the plugins.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'Plugins installed successfully' );
  }

}
