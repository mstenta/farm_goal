<?php

namespace Drupal\farm_goal\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Locale\CountryManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form for configuring farm goals.
 *
 * @ingroup farm
 */
class FarmGoalsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'farm_settings_farm_goal';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['goals'] = [
      '#type' => 'checkboxes',
      '#options' => [
        'profitability' => $this->t('Profitability'),
        'biodiversity' => $this->t('Biodiversity'),
        'soil_health' => $this->t('Soil health'),
        'organic' => $this->t('Organic certification'),
      ],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  protected function getEditableConfigNames() {
    return [];
  }

}
