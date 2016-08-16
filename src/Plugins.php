<?php

namespace YM\Profile;

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
   * @var string $data_type expected data type.
   */
  protected $data_type = 'plugins';

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
    \WP_CLI::success( 'Plugins installed successfully' );
  }

}
