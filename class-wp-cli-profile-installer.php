<?php

namespace Wp_Cli_Profile;

use Symfony\Component\Yaml\Parser;

/**
 * Base class for WP-CLI Profile Installer commands that deal with installing.
 * a Wordpress website from a profile.
 *
 */
class Installer extends \WP_CLI_Command {

  /**
   * @var string $file_path expected file path.
   */
  protected $file_path = '';

  /**
   * @var string $data_type the data type.
   */
  protected $data_type = '';

  /**
   * @var array[string] $allowed_data_types the allowed data types.
   *  e.g. plugins | themes.
   */
  protected $allowed_data_types = array(
    'site',
    'plugins',
    'themes',
  );

  /**
   * @var array $data the data from the file.
   */
  protected $data = array();

  /**
   * @var object $yaml_parser the yaml parser object.
   */
  protected $yaml_parser = null;

  public function __construct() {
    // Exit script execution in case we don't have the needed dependency of
    // Symphony yaml parser class/instance.
    if ( !class_exists('Symfony\Component\Yaml\Parser') || !$this->yaml_parser = new Parser() ) {
      \WP_CLI::error( 'Symphony yaml parser was not found! - Need to run composer install!' );
    }
  }

  /**
   * Process the file path from relative to absolute.
   *
   * Check if the given file exists. In case the file does not exists, Then
   * exits the script with an error message. Else store the absolute file path.
   *
   * @param $relative_file_path
   *  string
   */
  protected function Process_File_path($relative_file_path) {
    // Get the file path.
    $absolute_file_path = getcwd() . '/' . $relative_file_path;

    // In case the file does not exists.
    if ( !file_exists( $absolute_file_path ) ) {
      $message = 'The file path: @path was not found!';
      \WP_CLI::error( strtr( $message , array( '@path' => $absolute_file_path ) ) );
    }

    // Store the absolute path.
    $this->file_path = $absolute_file_path;
  }

  /**
   * @when before_wp_load
   *
   * Install a wordpress site from a profile.
   * command "profile-installer".
   *
   * @param $args
   * @param $assoc_args
   *
   */
  public function __invoke( $args, $assoc_args ) {
    // Process the file path and validate it's existence.
    $this->Process_File_path( reset( $args ) );

    // Get the yaml data from the file.
    $this->data = $this->yaml_parser->parse( ( file_get_contents( $this->file_path ) ) );
    $this->data_type = key($this->data);

    if ( !in_array($this->data_type , $this->allowed_data_types ) ) {
      $message = 'Data type: "@data_type" is incorrect the allowed types are: @allowed_types';
      $variables = array( '@data_type' => $this->data_type , '@allowed_types' => implode( ', ' , $this->allowed_data_types ) );
      \WP_CLI::error( strtr( $message , $variables ) );
    }

    \WP_CLI::success( print_r( $this->data ) );
  }
}

\WP_CLI::add_command( 'profile-installer', __NAMESPACE__ . '\Installer' );
