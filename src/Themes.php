<?php

namespace YM\Profile;

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
   * @var string $data_type expected data type.
   */
  protected $data_type = 'themes';

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
   * Install process for the plugins.
   *
   */
  public function execute_command() {
    \WP_CLI::success( 'Themes installed successfully' );
  }

}
