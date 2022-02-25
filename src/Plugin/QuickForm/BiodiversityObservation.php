<?php

namespace Drupal\farm_goal\Plugin\QuickForm;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\farm_quick\Plugin\QuickForm\QuickFormBase;
use Drupal\farm_quick\Traits\QuickLogTrait;
use Psr\Container\ContainerInterface;

/**
 * Biodiversity observation quick form.
 *
 * @QuickForm(
 *   id = "biodiversity_observation",
 *   label = @Translation("Biodiveristy observation"),
 *   description = @Translation("Record an observation of biodiversity."),
 *   helpText = @Translation("This form will create an observation log to record observations of biodiversity."),
 *   permissions = {
 *     "create observation log",
 *   }
 * )
 */
class BiodiversityObservation extends QuickFormBase {

  use QuickLogTrait;

  /**
   * The time service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $time;

  /**
   * Constructs a BiodiversityObservation object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   The time service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MessengerInterface $messenger, TimeInterface $time) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $messenger);
    $this->time = $time;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('messenger'),
      $container->get('datetime.time'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['birds'] = [
      '#type' => 'number',
      '#title' => $this->t('How many birds do you see?'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Create the log.
    $this->createLog([
      'type' => 'observation',
      'name' => $this->t('Biodiversity observation'),
      'timestamp' => $this->time->getRequestTime(),
      'quantity' => [
        [
          'measure' => 'count',
          'value' => $form_state->getValue('birds'),
          'label' => 'bird count',
        ],
      ],
      'flag' => [
        'goal_biodiversity',
      ],
      'status' => 'done',
    ]);
  }

}
