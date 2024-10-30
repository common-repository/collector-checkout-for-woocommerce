# Krokedil\ShopWidgets\Abstracts\AbstractWidget  

Abstract Widget class.

## Implements:
Krokedil\ShopWidgets\Interfaces\WidgetInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#abstractwidget__construct)|Class constructor.|
|[enqueue_assets](#abstractwidgetenqueue_assets)|Enqueue the assets for the widget.|
|[get_default_option](#abstractwidgetget_default_option)|Get the default option for the widget placement.|
|[get_hook](#abstractwidgetget_hook)|Get the hook to add the widget to.|
|[get_output](#abstractwidgetget_output)|Get the output of the widget.|
|[get_placement_options](#abstractwidgetget_placement_options)|Get the options for the widget placements.|
|[get_plugin_settings](#abstractwidgetget_plugin_settings)|Get the settings for the plugin that is adding the widget.|
|[get_priority](#abstractwidgetget_priority)|Get the priority for the widget.|
|[get_script_handles](#abstractwidgetget_script_handles)|Get the script handles.|
|[get_setting](#abstractwidgetget_setting)|Get the setting value for the widget.|
|[get_setting_fields](#abstractwidgetget_setting_fields)|Get the widget settings that can be added to the plugin using the widget.|
|[get_slug](#abstractwidgetget_slug)|Get the widget slug to append to the settings.|
|[get_style_handles](#abstractwidgetget_style_handles)|Get the style handles.|
|[init](#abstractwidgetinit)|Initialize the widget and register the actions to add the widget.|
|[is_enabled](#abstractwidgetis_enabled)|Is the widget enabled?|
|[is_valid_page](#abstractwidgetis_valid_page)|Is the page valid for the widget?|
|[render](#abstractwidgetrender)|Render the widget.|
|[set_hook](#abstractwidgetset_hook)|Set the hook to add the widget to.|
|[set_output](#abstractwidgetset_output)|Set the output of the widget.|
|[set_plugin_settings](#abstractwidgetset_plugin_settings)|Set the settings for the plugin that is adding the widget.|
|[set_priority](#abstractwidgetset_priority)|Set the priority of the hook.|
|[set_script_handles](#abstractwidgetset_script_handles)|Set the script handles.|
|[set_style_handles](#abstractwidgetset_style_handles)|Set the style handles.|




### AbstractWidget::__construct  

**Description**

```php
public __construct (string $plugin_slug, array $plugin_settings)
```

Class constructor. 

 

**Parameters**

* `(string) $plugin_slug`
: The slug for the plugin that is adding the widget.  
* `(array) $plugin_settings`
: The settings for the plugin that is adding the widget.  

**Return Values**

`void`




<hr />


### AbstractWidget::enqueue_assets  

**Description**

```php
public enqueue_assets (void)
```

Enqueue the assets for the widget. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`




<hr />


### AbstractWidget::get_default_option  

**Description**

```php
public get_default_option (void)
```

Get the default option for the widget placement. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`




<hr />


### AbstractWidget::get_hook  

**Description**

```php
public get_hook (void)
```

Get the hook to add the widget to. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`




<hr />


### AbstractWidget::get_output  

**Description**

```php
public get_output (void)
```

Get the output of the widget. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`




<hr />


### AbstractWidget::get_placement_options  

**Description**

```php
public get_placement_options (void)
```

Get the options for the widget placements. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string[]`




<hr />


### AbstractWidget::get_plugin_settings  

**Description**

```php
public get_plugin_settings (void)
```

Get the settings for the plugin that is adding the widget. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`




<hr />


### AbstractWidget::get_priority  

**Description**

```php
public get_priority (void)
```

Get the priority for the widget. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`int`




<hr />


### AbstractWidget::get_script_handles  

**Description**

```php
public get_script_handles (void)
```

Get the script handles. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string[]`




<hr />


### AbstractWidget::get_setting  

**Description**

```php
public get_setting (string $setting_key, mixed $default_value)
```

Get the setting value for the widget. 

 

**Parameters**

* `(string) $setting_key`
: The key for the setting, without the prefix.  
* `(mixed) $default_value`
: The default value to return if the setting is not set. Default is false.  

**Return Values**

`mixed`




<hr />


### AbstractWidget::get_setting_fields  

**Description**

```php
public get_setting_fields (string $title)
```

Get the widget settings that can be added to the plugin using the widget. 

 

**Parameters**

* `(string) $title`
: The title of the widget.  

**Return Values**

`array`




<hr />


### AbstractWidget::get_slug  

**Description**

```php
public get_slug (void)
```

Get the widget slug to append to the settings. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`




<hr />


### AbstractWidget::get_style_handles  

**Description**

```php
public get_style_handles (void)
```

Get the style handles. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string[]`




<hr />


### AbstractWidget::init  

**Description**

```php
public init (void)
```

Initialize the widget and register the actions to add the widget. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`




<hr />


### AbstractWidget::is_enabled  

**Description**

```php
public is_enabled (void)
```

Is the widget enabled? 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`




<hr />


### AbstractWidget::is_valid_page  

**Description**

```php
public is_valid_page (void)
```

Is the page valid for the widget? 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`




<hr />


### AbstractWidget::render  

**Description**

```php
public render (void)
```

Render the widget. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`




<hr />


### AbstractWidget::set_hook  

**Description**

```php
public set_hook (string $hook)
```

Set the hook to add the widget to. 

 

**Parameters**

* `(string) $hook`
: The hook to add the widget to.  

**Return Values**

`self`




<hr />


### AbstractWidget::set_output  

**Description**

```php
public set_output (string $output)
```

Set the output of the widget. 

 

**Parameters**

* `(string) $output`
: The output of the widget.  

**Return Values**

`self`




<hr />


### AbstractWidget::set_plugin_settings  

**Description**

```php
public set_plugin_settings (array $plugin_settings)
```

Set the settings for the plugin that is adding the widget. 

 

**Parameters**

* `(array) $plugin_settings`
: The settings for the plugin that is adding the widget.  

**Return Values**

`self`




<hr />


### AbstractWidget::set_priority  

**Description**

```php
public set_priority (int $priority)
```

Set the priority of the hook. 

 

**Parameters**

* `(int) $priority`
: The priority of the hook.  

**Return Values**

`self`




<hr />


### AbstractWidget::set_script_handles  

**Description**

```php
public set_script_handles (string[] $script_handles)
```

Set the script handles. 

 

**Parameters**

* `(string[]) $script_handles`
: The script handles.  

**Return Values**

`self`




<hr />


### AbstractWidget::set_style_handles  

**Description**

```php
public set_style_handles (string[] $style_handles)
```

Set the style handles. 

 

**Parameters**

* `(string[]) $style_handles`
: The style handles.  

**Return Values**

`self`




<hr />

