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
   * Validating the file data structure.
   *
   */
  public function validate_data_structure() {

      // Validate that the data does not contain any unknown properties.
      $this->validate_data_allowed_properties();

      $this->validate_data_required_properties($this->data_structure['required_properties'], $this->data);







//      WP_CLI::line( print_r( $this->data ) );
//      WP_CLI::line( print_r( Utils::get_array_keys( $this->data ) ) );
  }



  /**
   * Creating of the database.
   *
   */
  public function validate_data_required_properties($required_data, $data) {



    // Iterate over the data properties and validate that properties are have
    // been declared as expected.
    $current_key = null;
    foreach ($required_data as $key => $value) {

      // In case it's a missing key value per property.
      if ( ! is_array( $value ) && empty( $data[$value] ) ) {
        $variables = array(
          '@property' => $current_key ?  ( $current_key . ': ' . $value ) : $value,
        );
        WP_CLI::error( strtr( 'Property: \'@property\' is required', $variables ) );
      }

      // In case it's an array.
      if ( is_array( $value ) ) {
        $current_key = $key;
        $this->validate_data_required_properties($required_data[$key], $data[$key]);
        return $current_key;
      }

    }
  }

  /**
   * Creating of the database.
   *
   */
  public function execute_command() {
    WP_CLI::success( 'Database created' );
  }

}
