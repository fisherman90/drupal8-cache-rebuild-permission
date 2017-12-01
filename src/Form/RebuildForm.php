<?php
/**
 * @file
 * Contains \Drupal\cache_rebuild_permission\Form\RebuildForm.
 */

namespace Drupal\cache_rebuild_permission\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RebuildForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cache_rebuild_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#type' => 'markup',
      '#markup' => '<p>'
        . $this->t('If you submit this button, the whole cache for this site will be rebuild.')
        . '</p><p>'
        . '<strong>' . $this->t('Beware:') . '</strong> '
        . $this->t('On big platforms this can render the system unresponsive for some seconds.')
        . '</p>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Flush all caches'),
      '#button_type' => 'secondary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if (\Drupal::currentUser()->hasPermission('access cache rebuild')) {
      drupal_flush_all_caches();
      drupal_set_message($this->t('All caches cleared.'));
    }
  }

}