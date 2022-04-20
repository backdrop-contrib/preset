<?php
/**
 * @file
 * API documentation and examples for the Preset API module.
 */

/**
 * Define preset types.
 *
 * @return array
 *   An associative array of preset types, where the keys are preset type names
 *   and the values are associative arrays of preset type properties with the
 *   following key-value pairs:
 *   - name: The translated label of the preset type.
 *   - path: The URL path to the listing page.
 *   - path_title: The translated title of the listing page.
 *   - name_plural: (optional) The translated plural label of the preset type.
 *     Defaults to the value of `name` appended with an 's'.
 *   - path_description: (optional) The translated description of the listing
 *     page. Defaults to none.
 *   - id_name: (optional) The translated label of the preset ID field. Defaults
 *     to 'Title'.
 *   - columns: (optional) An associative array of fields to display as
 *     additional columns in the table on the listing page. The keys are field
 *     IDs (from `hook_preset_form()`) and the values are translated column
 *     names. Defaults to none.
 *   - permission: (optional) The permission name for administering the preset
 *     type. Defaults to 'administer site configuration'.
 */
function hook_preset_types() {
  return array(
    'images' => array(
      'name' => t('Image preset'),
      'path' => 'admin/config/media/image-presets',
      'path_title' => t('Image presets'),
      'name_plural' => t('Image presets'),
      'path_description' => t('Configure presets for image fields.'),
      'id_name' => t('Preset name'),
      'columns' => array(
        'style' => t('Image style'),
        'align' => t('Aligned'),
      ),
      'permission' => 'administer image presets',
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
