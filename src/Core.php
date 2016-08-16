<?php

namespace YM\Profile;

/**
 * Command that installs the site plugins.
 *
 * ## EXAMPLE
 *
 *     # Download Wordpress core
 *     $ wp profile-install core example/core.yml
 *     Success: WordPress downloaded successfully.
 *
 */
class Core extends Installer {

  /**
   * @var string $data_type expected data type.
   */
  protected $data_type = 'core';

  /**
   * Downloads WordPress core from a config Yaml file.
   *
   * ## OPTIONS
   *
   * <config-file>
   * : The config file relative path.
   *
   * ## EXAMPLES
   *
   * wp profile-install core example/core.yml
   *
   */
  public function __invoke( $args, $assoc_args ) {
    parent::__invoke( $args, $assoc_args );
  }

  /**
   * Download WordPress core.
   *
   */
  public function execute_command() {
    \WP_CLI::success( 'WordPress downloaded successfully' );
  }

}
