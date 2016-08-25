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
  protected $data_structure = array (
    'allowed_properties' => array(),
    'required_properties' => array(),
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
   * Installing a WordPress site.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'WordPress installed successfully' );
  }

}
