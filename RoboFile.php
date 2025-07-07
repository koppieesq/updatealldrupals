<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
use Robo\Contract\ConfigAwareInterface;
use Robo\Common\ConfigAwareTrait;
use Symfony\Component\Console\Style\SymfonyStyle;

class RoboFile extends \Robo\Tasks implements ConfigAwareInterface
{
  use ConfigAwareTrait;

  function updateme ($opts = ['path' => null]) {
    // New way of printing output.
    $io = new SymfonyStyle($this->input(), $this->output());
    $io->title('UPDATE ALL THE THINGS!!!');

    // Load variables from robo.yml.
    $config = $this->getConfig()->export();
    $path = $opts['path'] ?: $config['path_to_root'];
    $drush = $path . '/vendor/bin/drush';
    $commands = $config['commands'];

    // Figure out where the webroot is, using composer.json.
    $composer = json_decode(file_get_contents($path . '/composer.json'), true);
    $webroot = $composer['extra']['drupal-scaffold']['locations']['web-root'];

    // Composer install.
    $this->taskExec('composer install')->run();

    // Move to the sites directory.
    $io->info('Moving to sites directory...');
    chdir($path);
    $sitesDir = $path . $webroot . 'sites';
    $sites = array_filter(
      scandir($sitesDir),
      function ($item) use ($sitesDir) {
        return $item !== '.' && $item !== '..' && is_dir($sitesDir . '/' . $item);
      }
    );

    foreach ($sites as $site) {
      $io->section($site);
      // Move to the site subdirectory
      $sitePath = $sitesDir . '/' . $site;
      $io->info('Moving to ' . $sitePath);
      chdir($sitePath);

      // Pull commands from robo.yml, and run in sequence.
      if (!empty($commands) && is_array($commands)) {
        foreach ($commands as $cmd) {
          $this->taskExec($drush . ' ' . $cmd)->run();
        }
      }
    }

    $io->success('All done!  Pat yourself on the back for a job well done.');
  }
}
