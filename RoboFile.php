<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
  function updateme ($path) {
    $this->io()->title("UPDATE ALL THE THINGS!!!");

    // Load sites, commands, and path to webroot
    $sites = $opts["sites"];
    $commands = $opts["commands"];
    $path = $path ? $path : "/var/www/d7/sites";

    // Move to the sites directory.

    foreach ($sites as $site) {
      $this->io()->section($site);
      // Move to the site subdirectory

      // Run commands in sequence.
      foreach ($commands as $key => $value) {
        $this->say($key);
        $this->_exec($value);
      }
    }

    $this->io()->info("All done!  Pat yourself on the back for a job well done.");
  }
}
