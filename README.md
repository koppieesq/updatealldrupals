# updatealldrupals

A Robo script to automate updates for all sites in a Drupal multisite installation.

## Features

- Runs `composer install` to ensure dependencies are up to date.
- Executes several basic Drush commands for every site in the multisite.

## Requirements

- PHP (compatible with Robo and Drupal)
- Composer
- Drush
- Robo

## Usage

1. Clone or download this repository.  (You can install this anywhere you like, but keep it out of the webroot.)
2. Install dependencies:
   ```bash
   composer install
   ```
3. Run the Robo task to update all sites:
   ```bash
   vendor/bin/robo updateme
   ```

This will:
- Install/update Composer dependencies.
- Run `drush updb -y` for each site, to run database updates.
- Run `drush cr` for each site, to clear the cache.

## Configuration

- Ensure your multisite structure is set up according to Drupal standards.
- Edit `robo.yml` or `RoboFile.php` if you need to customize site discovery or deployment steps.
- **Easy Mode:** Add a flag to the command line: `vendor/bin/robo updateme --path=/path/to/multisite`

## License

GPL3
