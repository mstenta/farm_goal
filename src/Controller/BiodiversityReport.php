<?php

namespace Drupal\farm_goal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\views\Views;

/**
 * Biodiversity report controller.
 */
class BiodiversityReport extends ControllerBase {

  /**
   * The biodiversity report.
   *
   * @return array
   *   Returns a render array.
   */
  public function report(): array {

    // Render the biodiversity logs view.
    // Load the view. Note that this
    // returns a special ViewExecutable object, not a View entity.
    $view = Views::getView('biodiversity_logs');

    // Skip if the view doesn't exist or access check fails.
    if (empty($view) || !$view->access('page')) {
      return [];
    }

    // Set the display so we get the correct title.
    $view->setDisplay('page');

    // Add a map above the table of logs.
    $map = [
      '#type' => 'farm_map',
      '#map_type' => 'biodiversity_logs',
      '#attached' => [
        'library' => ['farm_goal/biodiversity_logs'],
      ],
    ];
    $view->attachment_before['biodiversity_logs_map'] = $map;

    // Build the views renderable output.
    $output = $view->buildRenderable('page', []);

    return $output;
  }

}
