<?php

namespace YM\Profile;

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
   * @var string $data_type expected data type.
   */
  protected $data_type = 'options';

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
    \WP_CLI::success( 'Options created' );
  }

}
