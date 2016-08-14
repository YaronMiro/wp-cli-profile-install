YaronMiro/wp-cli-profile-installer
===============================

##Current status: still in development not ready for production!##

wp-cli profile command for managing Plugins & Themes on a clean site installation using a Yaml config file.

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing)

## Using

~~~
wp profile-installer <relative-file-path>
~~~

**EXAMPLES**

    # Manage the site themes.
    wp profile-installer example/themes.yml

    # Manage the site plugins.
    wp profile-installer example/plugins.yml



## Installing

**Installing as a WP-CLI package:**

Installing this package requires WP-CLI v0.24.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with `wp package install YaronMiro/wp-cli-profile-installer`

**Installing as standalone plug-in:**

git cone and composer install


If installed as a plugin you need to run composer install

## Contributing

Code and ideas are more than welcome.

Please [open an issue](https://github.com/YaronMiro/wp-cli-profile-installer/issues) with questions, feedback, and violent dissent. Pull requests are expected to include test coverage.
