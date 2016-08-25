<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * Command that installs the site database.
 *
 * ## EXAMPLE
 *
 *     # Create a fresh database
 *     $ wp profile-install db example/database.yml
 *     Success: Database created.
 */
class Database extends Installer {

  /**
   * @var array $data_structure the file data structure.
   */
  protected $data_structure = array(
    'allowed_properties' => array (
      'name',
      'hostname',
      'user',
      'name',
      'password',
      'prefix',
      'collate',
      'charset',
    ),
    'required_properties' => array(
      'name',
      'hostname',
      'user' => array(
        'name',
        'password',
      ),
    ),
  );

  /**
   * Install a WordPress site database from a config Yaml file.
   *
   * ## OPTIONS
   *
   * <config-file>
   * : The config file relative path.
   *
   * ## EXAMPLES
   *
   * wp profile-install db example/database.yml
   *
   */
  public function __invoke( $args, $assoc_args ) {
    parent::__invoke( $args, $assoc_args );
  }

  /**
   * Creating of the database.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'Database created' );
    WP_CLI::line( print_r( $this->data ) );
  }

}
