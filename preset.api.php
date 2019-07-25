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
 *   - path: Required. The URL path to the listing page.
 *   - id_name: The human-readable name of the preset ID field. Defaults to
 *     'Title'.
 *   - name_plural: The human-readable plural name of the preset type. Defaults
 *     to the value of `name` appended with an 's'.
 *   - description: The description of the preset type. Defaults to none.
 *   - columns: An associative array of fields to display as additional columns
 *     in the table on the listing page. The keys of the array are field IDs
 *     (from hook_crud_form()) and the values are column names. Defaults to
 *     none.
 *   - permission: The permission name for administering the preset type.
 *     Defaults to 'administer site configuration'.
 */
function hook_preset_types() {
  return array(
    'images' => array(
      'name' => 'Image preset',
      'path' => 'admin/config/media/image-presets',
      'id_name' => 'Preset name',
      'name_plural' => 'Image presets',
      'description' => 'A configuration preset for image fields.',
      'columns' => array(
        'style' => 'Image style',
        'align' => 'Aligned',
      ),
      'permission' => 'administer image presets',
    ),
  );
}

/**
 * Create the form for adding/editing presets.
 *
 * @param string $preset_type
 *   The machine name of the preset type this form is used for. If you are
 *   creating forms for multiple preset types, it is recommended to use a
 *   `switch` statement here and then call a different function for each preset
 *   type. This avoids having multiple form definitions in one function.
 * @param string $id
 *   The ID of the existing preset to edit. This is `NULL` when adding a new
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

