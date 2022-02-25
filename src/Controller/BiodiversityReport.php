<?php

namespace Drupal\farm_goal\Controller;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Menu\MenuLinkTreeInterface;
use Drupal\Core\Menu\MenuTreeParameters;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
    return [];
  }

}
