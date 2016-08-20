<?php

namespace YaronMiro\WpProfile;

if ( ! class_exists( 'WP_CLI' ) ) {
  return;
}

use WP_CLI;
use WP_CLI_Command;

/**
 * Command to displays General Info about wp profile-install commands.
 *
 * ## EXAMPLE
 *
 *     # Display information about the `wp profile-install`.
 *     $ wp profile-install info
 *
 *      | Wp Profile General Information
 *     --------------------------------------------------
 *      | Version: 1.0.0
 *     --------------------------------------------------
 *      | Created by: Yaron Miro
 *     --------------------------------------------------
 *      | Project: https://github.com/YaronMiro/wp-profile
 *
 */
class Info extends WP_CLI_Command {

  /**
   * @const string $file_path the config file path.
   */
  const YM_WP_PROFILE_INSTALL_VERSION = '1.0.0';

  /**
   * Displays General Info about wp profile-install commands.
   *
   * ## EXAMPLES
   *
   * wp profile-install info
   *
   */
  public function __invoke( $args, $assoc_args ) {
    WP_CLI::line();
    WP_CLI::line();
    WP_CLI::line( '  | Wp Profile General Information' );
    WP_CLI::line( ' ----------------------------------------------------_' );
    WP_CLI::line( '  | Version: ' . self::YM_WP_PROFILE_INSTALL_VERSION  );
    WP_CLI::line( ' -----------------------------------------------------' );
    WP_CLI::line( '  | Created by: Yaron Miro' );
    WP_CLI::line( ' -----------------------------------------------------' );
    WP_CLI::line( '  | Project: https://github.com/YaronMiro/wp-profile' );
    WP_CLI::line();
    WP_CLI::line();
  }
}
