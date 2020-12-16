Preset API
==========

Preset API is an API module that provides a user interface for managing
configuration presets.

A configuration preset is a collection of settings that are saved to, and read
from, config. If your module needs a UI for adding, editing and deleting
configuration presets, Preset API will do the heavy lifting for you.

As an API, this module does not do anything on its own. It simply provides hooks
for other modules to implement.

Example Use Case
----------------

As an example, consider the following hypothetical module that provides image
presets. When editors upload images on the site, they can choose a preset which
determines how each image will be displayed and what functionality it has.
Examples include 'Floated thumbnail', which would display a small version of the
image floated to the side of their content, or 'Medium lightbox', which would
display a medium-sized image that opens a full-size image in a lightbox when
clicked.

To setup the image presets, our module needs to:

1. Implement `hook_preset_types()`.

  This hook defines the preset type(s) the module will use. In this example,
  there's just one: 'Image preset'. The path given here is
  `admin/config/media/image-presets` which means this is where admins can go to
  view, add, edit and delete image presets. Note that the Preset API module
  handles the creation of these menu paths, so our module doesn't need to
  implement `hook_menu()`.

1. Implement `hook_preset_form()`.

  This hook is where our module creates the form admins will see when
  creating/editing an image preset. The title/machine name fields for the preset
  are automatically provided, so our module just needs to add fields for
  selecting an image style, selecting where to float an image, choosing if a
  lightbox should be used, etc.

1. Implement `hook_config_info()` and provide default config file(s).

  Our module still needs to provide the config file for storing the image
  presets. Preset API stores presets in config files named
  `[OUR-MODULE].[PRESET-TYPE].json`, where the field values are saved as
  `[PRESET-NAME].[FIELD-NAME]`.

View the `preset.api.php` file for more API documentation and examples.

Installation
------------

- Install this module using the official Backdrop CMS instructions at
  https://backdropcms.org/guide/modules.

Issues
------

Bugs and Feature requests should be reported in the Issue Queue:
https://github.com/backdrop-contrib/preset/issues.

Current Maintainers
-------------------

- Peter Anderson (https://github.com/BWPanda).

Credits
-------

- Created for Backdrop CMS by Peter Anderson (https://github.com/BWPanda).

License
-------

This project is GPL v2 software. See the LICENSE.txt file in this directory for
complete text.
