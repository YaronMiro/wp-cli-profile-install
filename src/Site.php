<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * Command that installs the WordPress site.
 *
 * ## EXAMPLE
 *
 *     # Install WordPress Site
 *     $ wp profile-install site example/site.yml
 *     Success: WordPress installed successfully.
 *
 */
class Site extends Installer {

  /**
   * @var array $data_structure the file data structure.
   */
  protected $data_structure = array(
    'required' => array(),
    'not_required' => array(),
  );

  /**
   * Install a WordPress site from a config Yaml file.
   *
   * ## OPTIONS
   *
   * <config-file>
   * : The config file relative path.
   *
   * ## EXAMPLES
   *
   * wp profile-install site example/site.yml
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
   * Installing a WordPress site.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'WordPress installed successfully' );
  }

}
