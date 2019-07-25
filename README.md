Preset API
==========

Preset API is an API module that provides a user interface for managing
configuration presets.

A configuration preset is a collection of settings that are saved to, and read
from, config. If your module needs a UI for adding, editing and deleting
configuration presets, Preset API will do the heavy lifting for you.

As an API, this module does not do anything on its own. It simply provides hooks
for other modules to implement.

Using the API
-------------

View the `preset.api.php` file for API documentation and examples.

Your module defines 'Preset Types' (e.g. 'Image preset'), this module provides a
user interface for them (e.g. 'admin/config/media/image-presets'), and then your
users can add, edit and delete the presets themselves (e.g. 'Floated thumbnail',
'Linked medium image', etc.).

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

