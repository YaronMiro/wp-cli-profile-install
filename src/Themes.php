<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * Command that installs the site themes.
 *
 * ## EXAMPLE
 *
 *     # Install the site themes
 *     $ wp profile-install themes example/plugins.yml
 *     Success: Themes installed successfully.
 *
 */
class Themes extends Installer {

  /**
   * @var array $data_structure the file data structure.
   */
  protected $data_structure = array();

  /**
   * Install a WordPress site themes from a config Yaml file.
   *
   * ## OPTIONS
   *
   * <config-file>
   * : The config file relative path.
   *
   * ## EXAMPLES
   *
   * wp profile-install themes example/themes.yml
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
    WP_CLI::success( 'Themes installed successfully' );
  }

}
