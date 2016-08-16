<?php

namespace YM\Profile;

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
   * @var string $data_type expected data type.
   */
  protected $data_type = 'database';

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
    \WP_CLI::success( 'Database created' );
  }

}
