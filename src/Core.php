<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * Command that installs the site plugins.
 *
 * ## EXAMPLE
 *
 *     # Download WordPress core
 *     $ wp profile-install core example/core.yml
 *     Success: WordPress downloaded successfully.
 *
 */
class Core extends Installer {

  /**
   * @var array $data_structure the file data structure.
   */
  protected $data_structure = array (
    'required' => array(),
    'not_required' => array(),
  );

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
   * Validating the file data structure.
   *
   */
  public function validate_data_structure() {
    WP_CLI::line( print_r($this->data_structure) );
  }

  /**
   * Download WordPress core.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'WordPress downloaded successfully' );
  }

}
