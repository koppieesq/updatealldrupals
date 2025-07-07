# updatealldrupals

A Robo script to automate updates for all sites in a Drupal multisite installation.

## Features

- Runs `composer install` to ensure dependencies are up to date.
- Executes `drush deploy` for every site in the multisite, streamlining multiple deployment steps into a single command.

## Requirements

- PHP (compatible with Robo and Drupal)
- Composer
- Drush
- Robo

## Usage

1. Clone or download this repository.
2. Install dependencies:
   ```bash
   composer install
   ```
3. Run the Robo task to update all sites:
   ```bash
   vendor/bin/robo update:all
   ```
   (Adjust the command if your Robo task uses a different name.)

This will:
- Install/update Composer dependencies.
- Run `drush deploy` for each multisite, applying database updates, config imports, and other deployment tasks as defined.

## Configuration

- Ensure your multisite structure is set up according to Drupal standards.
- Edit `robo.yml` or `RoboFile.php` if you need to customize site discovery or deployment steps.

## License

MIT