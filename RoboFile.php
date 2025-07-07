<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
  function updateme () {
    // New way of printing output.
    $io = new Symfony\Component\Console\Style\SymfonyStyle($this->input(), $this->output());
    $io->title("UPDATE ALL THE THINGS!!!");

    // Load variables from robo.yml.
    $opts = $this->getConfig();
    $path = $opts["path_to_root"];
    $drush = $opts["path_to_drush"];

    // Move to the sites directory.
    chdir($path);
    $sitesDir = $path . '/sites';
    $sites = array_filter(
      scandir($sitesDir),
      function ($item) use ($sitesDir) {
        return $item !== '.' && $item !== '..' && is_dir($sitesDir . '/' . $item);
      }
    );

    foreach ($sites as $site) {
      $io->section($site);
      // Move to the site subdirectory
      chdir($sitesDir . '/' . $site);

      // Run commands in sequence.
      $this->taskExec($drush . ' deploy')->run();
    }

    $io->success("All done!  Pat yourself on the back for a job well done.");
  }
}
