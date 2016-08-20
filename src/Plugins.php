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
  protected $data_structure = array();

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
   * Validating the file data structure.
   *
   */
  public function validate_data_structure() {
    WP_CLI::line( print_r($this->data_structure) );
  }

  /**
   * Install process for the plugins.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'Plugins installed successfully' );
  }

}
