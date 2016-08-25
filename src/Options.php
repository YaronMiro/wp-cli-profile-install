<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * Command that installs the site database.
 *
 * ## EXAMPLE
 *
 *     # Add custom options
 *     $ wp profile-install options example/options.yml
 *     Success: Options created.
 */
class Options extends Installer {

  /**
   * @var array $data_structure the file data structure.
   */
  protected $data_structure = array (
    'allowed_properties' => array(),
    'required_properties' => array(),
  );

  /**
   * Creates custom site options from a config Yaml file.
   *
   * ## OPTIONS
   *
   * <config-file>
   * : The config file relative path.
   *
   * ## EXAMPLES
   *
   * wp profile-install options example/options.yml
   *
   */
  public function __invoke( $args, $assoc_args ) {
    parent::__invoke( $args, $assoc_args );
  }

  /**
   * Creating custom site options.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'Options created' );
  }

}
