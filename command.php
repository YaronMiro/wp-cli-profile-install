<?php

namespace YM\Profile;

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

// Include the Symphony Yaml parser
use Symfony\Component\Yaml\Parser;

/**
 *
 * Base class for all the profile install sub commands.
 *
 */
abstract class Installer extends \WP_CLI_Command {

  /**
   * @var string $file_path the config file path.
   */
  private $file_path = '';

  /**
   * @var array $allowed_file_types config file types.
   */
  private $allowed_file_types = array( 'yml', 'yaml' );

  /**
   * @var string $data_type the data type.
   */
  protected $data_type = '';

  /**
   * @var array $data the data from the file.
   */
  protected $data = array();

  /**
   * @var object $data_parser the data parser object.
   */
  private $data_parser = null;

  /**
   * Install a profile component via a unique command.
   *
   * Each sub-command process is unique. Therefore it is an abstract method that
   * must be implemented for each when sub-command extends this class.
   *
   */
  public abstract function execute_command();

  /**
   * Validate dependencies have been installed and loaded.
   *
   * The commands may have a dependency upon a other sources.
   * The sources must be installed and loaded prior to any command execution.
   */
  public function __construct() {
    $this->validate_dependencies_installation();
    $this->load_dependencies();
  }

  /**
   * Basic mandatory operations for a command execution.
   *
   */
  public function __invoke( $args, $assoc_args ) {

    // Process the file path and validate it's existence.
    $this->process_file_path( reset( $args ) );

    // Get the data from the file.
    $this->parse_data_from_file();

    // Validate data type.
    $this->validate_data_structure();

    // Install.
    $this->execute_command();
  }

  /**
   * Validate that dependencies have been installed.
   *
   * If the dependencies have not been installed then, exits the script with an
   * error message.
   *
   */
  protected function validate_dependencies_installation() {

    // validate the composer have installed the dependencies.
    if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
      \WP_CLI::error( 'Please, run composer install first' );
    }

  }

  /**
   * Load the dependencies.
   *
   * If the dependencies can't be loaded, then exits the script with an
   * error message.
   *
   */
  protected function load_dependencies() {
    // Load the file data parser.
    if ( ! class_exists('Symfony\Component\Yaml\Parser') || ! $this->data_parser = new Parser() ) {
      \WP_CLI::error( 'Can\'t execute the command due to missing dependencies' );
    }
  }

  /**
   * Parse the data from a given file.
   *
   */
  protected function parse_data_from_file() {
    $this->data = $this->data_parser->parse( ( file_get_contents( $this->file_path ) ) );
  }

  /**
   * Validate the data structure.
   *
   * if data type was structure is incorrect then, exits the script with an error message.
   *
   */

  protected function validate_data_structure() {

    // Validate the data type.
    $data_type = key( $this->data );
    if ( $data_type !== $this->data_type ) {

      // Error message.
      $message = 'Data type: "@data_type" is incorrect the allowed data type is: "@allowed_data_type"';

      // Message placeholders.
      $variables = array(
        '@data_type' => $data_type,
        '@allowed_data_type' => $this->data_type,
      );

      \WP_CLI::error( strtr( $message, $variables ) );
    }
  }

  /**
   * Process the file path from relative to absolute & validate it's integrity.
   *
   * @param $relative_file_path
   *  string
   *
   * Wrong file type or the file does not exists then,
   * exits the script with an error message.
   * File was found then, store the absolute file path.
   *
   */
  private function process_file_path( $relative_file_path ) {

    // Get the absolute file path.
    $absolute_file_path = getcwd() . '/' . $relative_file_path;

    // In case the file type is incorrect.
    $file_extension = strtolower( pathinfo( $absolute_file_path, PATHINFO_EXTENSION ) );
    if ( ! in_array( $file_extension , $this->allowed_file_types ) ) {

      // Error message.
      $message = 'File type: "@file_type" is incorrect. allowed file type are: "@allowed_file_types"';

      // Message placeholders.
      $variables = array(
        '@file_type' => $file_extension,
        '@allowed_file_types' => implode( ', ', $this->allowed_file_types ),
      );

      \WP_CLI::error( strtr( $message, $variables ) );
    }

    // In case the file does not exists.
    if ( ! file_exists( $absolute_file_path ) ) {
      \WP_CLI::error( strtr( 'File: "@file" was not found!', array( '@file' => $absolute_file_path ) ) );
    }

    // Store the absolute path.
    $this->file_path = $absolute_file_path;
  }
}

// Database command.
require_once('src/Database.php');
\WP_CLI::add_command( 'profile-install db', __NAMESPACE__ . '\Database', array( 'when' => 'before_wp_load' ) );

// Plugins command.
require_once('src/Plugins.php');
\WP_CLI::add_command( 'profile-install plugins', __NAMESPACE__ . '\Plugins', array( 'when' => 'before_wp_load' ) );

// Themes command.
require_once('src/Themes.php');
\WP_CLI::add_command( 'profile-install themes', __NAMESPACE__ . '\Themes', array( 'when' => 'before_wp_load' ) );

// Options command.
require_once('src/Options.php');
\WP_CLI::add_command( 'profile-install options', __NAMESPACE__ . '\Options', array( 'when' => 'before_wp_load' ) );

// Core command.
require_once('src/Core.php');
\WP_CLI::add_command( 'profile-install core', __NAMESPACE__ . '\Core', array( 'when' => 'before_wp_load' ) );

// Core command.
require_once('src/Site.php');
\WP_CLI::add_command( 'profile-install site', __NAMESPACE__ . '\Site', array( 'when' => 'before_wp_load' ) );
