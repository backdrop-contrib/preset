<?php
/**
 * @file
 * API documentation and examples for the Preset API module.
 */

/**
 * Define preset types.
 *
 * @return array
 *   An associative array of preset types. The keys of the array are preset type
 *   machine names and the values are associative arrays of properties for each
 *   preset type, with the following key-value pairs:
 *   - name: Required. The human-readable name of the preset type.
 *   - name_plural: The human-readable plural name of the preset type. Defaults
 *     to the value of `name` appended with an 's'.
 *   - path: Required. The URL path to the listing page.
 *   - path_title: Required. The title of the listing page.
 *   - path_description: The description of the listing page. Defaults to none.
 *   - id_name: The human-readable name of the preset ID field. Defaults to
 *     'Title'.
 *   - columns: An associative array of fields to display as additional columns
 *     in the table on the listing page. The keys of the array are field IDs
 *     (from hook_preset_form()) and the values are column names. Defaults to
 *     none.
 *   - permission: The permission name for administering the preset type.
 *     Defaults to 'administer site configuration'.
 *   - individual: TRUE if you would like configuration for each preset stored 
 *     in individual files, FALSE if you would like confifuration for all
 *     presets stored in a single file. 
 *   - group: The config group from hook_config_info().
 */
function hook_preset_types() {
  return array(
    'images' => array(
      'name' => 'Image preset',
      'name_plural' => 'Image presets',
      'path' => 'admin/config/media/image-presets',
      'path_title' => 'Image presets',
      'path_description' => 'Configure presets for image fields.',
      'id_name' => 'Preset name',
      'columns' => array(
        'style' => 'Image style',
        'align' => 'Aligned',
      ),
      'permission' => 'administer image presets',
      'individual' => FALSE,
    ),
    'video_style' => array(
      'name' => t('Video style'),
      'id_name' => t('Video style'),
      'name_plural' => t('Video styles'),
      'path' => 'admin/config/media/vef',
      'path_title' => t('Video styles'),
      'path_description' => t('Administer Video Embed Field\'s video styles.'),
      'permission' => 'administer video styles',
      'individual' => TRUE,
      'group' => t('Video styles'),
    ),
  );
}

/**
 * Create the form for adding/configuring presets.
 *
 * @param string $preset_type
 *   The machine name of the preset type this form is used for. If you are
 *   creating forms for multiple preset types, it is recommended to use a
 *   `switch` statement here and then call a different function for each preset
 *   type. This avoids having multiple form definitions in one function.
 * @param string $id
 *   The ID of the existing preset to confgure. This is `NULL` when adding a new
 *   preset.
 *
 * @return array
 *   An array of form API fields for the given preset type.
 */
function hook_preset_form($preset_type, $id) {
  $form = array();
  $config = config('[MODULE_NAME].' . $preset_type);

  // Get default values.
  $values = ($id) ? $config->get($id) : array();

  if ($preset_type == 'images') {
    $form['style'] = array(
      '#type' => 'select',
      '#title' => t('Image style'),
      '#options' => backdrop_map_assoc(array_keys(image_styles())),
      '#default_value' => isset($values['style']) ? $values['style'] : 'thumbnail',
    );
    $form['align'] = array(
      '#type' => 'select',
      '#title' => t('Alignment'),
      '#options' => array(
        'none' => t('None'),
        'left' => t('Left'),
        'right' => t('Right'),
      ),
      '#default_value' => isset($values['align']) ? $values['align'] : '',
    );
    $form['link'] = array(
      '#type' => 'url',
      '#title' => t('Link'),
      '#default_value' => isset($values['link']) ? $values['link'] : '',
    );
  }

  return $form;
}
