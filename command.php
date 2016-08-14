<?php

namespace WP_CLI_Profile;

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

// Include the Symphony Yaml parser
use Symfony\Component\Yaml\Parser;

/**
 * Perform install operations of a WordPress site straight from a profile.
 *
 * ## EXAMPLES
 *
 *     # Create a fresh database
 *     $ wp profile-installer db
 *     Success: Database created.
 *
 *     # Download WordPress core & Install WordPress.
 *     $ wp profile-installer create-site
 *     Success: WordPress downloaded.
 *     Success: WordPress installed successfully.
 *
 *     # Install the plugins
 *     $ wp profile-installer plugins
 *     Success: Plugins installed successfully.
 * 
 *     # Install the themes
 *     $ wp profile-installer themes
 *     Success: Themes installed successfully.
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
   * @var object $data_parser the data parser object.
   */
  protected $data_parser = null;

  /**
   * Load the file data parser.
   *
   * The commands have a dependency upon a file data parser.
   * The file data parser must be loaded prior to any command execution.
   */
  public function __construct() {
    $this->load_the_data_parser();
  }

  /**
   * Load the file data parser.
   *
   * If the data parser isn't loaded then exits the script with an error message.
   *
   */
  protected function load_the_data_parser() {
    if ( ! class_exists('Symfony\Component\Yaml\Parser') || !$this->data_parser = new Parser() ) {
      \WP_CLI::error( 'Symphony Yaml parser was not found! - Need to run composer install!' );
    }
  }

  /**
   * Get the data from a given file.
   *
   */
  protected function get_data_from_file() {
    $this->data = $this->data_parser->parse( ( file_get_contents( $this->file_path ) ) );
    $this->data_type = key($this->data);
  }

  /**
   * Load and validate the data parser existence.
   *
   * If the data parser isn't loaded then exits the script with an error message.
   *
   */
  protected function validate_data_type() {
    if ( ! in_array($this->data_type, $this->allowed_data_types ) ) {
      $message = 'Data type: "@data_type" is incorrect the allowed types are: @allowed_types';
      $variables = array( '@data_type' => $this->data_type, '@allowed_types' => implode( ', ', $this->allowed_data_types ) );
      \WP_CLI::error( strtr( $message, $variables ) );
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
  protected function process_file_path($relative_file_path) {
    // Get the file path.
    $absolute_file_path = getcwd() . '/' . $relative_file_path;

    // In case the file does not exists.
    if ( ! file_exists( $absolute_file_path ) ) {
      $message = 'File: @file was not found!';
      \WP_CLI::error( strtr( $message, array( '@file' => $absolute_file_path ) ) );
    }

    // Store the absolute path.
    $this->file_path = $absolute_file_path;
  }

  /**
   * Install a WordPress site from a profile.
   *
   * @param $args
   * @param $assoc_args
   *
   * @when before_wp_load
   *
   */
  public function __invoke( $args, $assoc_args ) {
    // Process the file path and validate it's existence.
    $this->process_file_path( reset( $args ) );

    // Get the data from the file.
    $this->get_data_from_file();

    // Validate data type.
    $this->validate_data_type();

    \WP_CLI::success( print_r( $this->data ) );
  }
}

\WP_CLI::add_command( 'profile-installer', __NAMESPACE__ . '\Installer' );
