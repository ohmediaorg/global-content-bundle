# Overview

Leverages the settings-bundle to provide an easy way to add various editable
content in global templates.

## Installation

Update `composer.json` by adding this to the `repositories` array:

```json
{
    "type": "vcs",
    "url": "https://github.com/ohmediaorg/global-content-bundle"
}
```

Then run `composer require ohmediaorg/global-content-bundle:dev-main`.

Import the routes in `config/routes.yaml`:

```yaml
oh_media_global_content:
    resource: '@OHMediaGlobalContentBundle/config/routes.yaml'
```

## Defining Global Content Areas

Create/edit `config/packages/oh_media_global_content.yaml`:

```yaml
oh_media_global_content:
    global_content:
        - {id: 'header_links', label: 'Header Links'}
        - {id: 'footer_links', label: 'Footer Links'}
        - {id: 'bottom_content', label: 'Bottom Content'}
```

You can add as many items as needed under `global_content`. Each of these will
result in an item in the table at `/admin/global-content`.

## Rendering Global Content Areas

Simply use the Twig function with the desired ID:

```twig
{{ global_content('header_links') }}
```

## Migrating a Setting to a Global Content Area

1. Add the ID/label to `config/packages/oh_media_global_content.yaml`
1. Create a migration to rename the setting to "global_content_{ID}".
1. Remove the old code to populate the setting.

_**NOTE:** the setting must already be using a WYSIWYG editor._
