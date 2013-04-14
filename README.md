# Tui SessionBundle

Adds a listener that expires user sessions after a configurable period of inactivity.

## Installation

Add this require & repository reference to your `composer.json`:

```json
//…
"repositories": [
    {
        "type": "vcs",
        "url": "http://github.com/inanimatt/csv-file.git"
    }
],
"require": {
    "tui/session-bundle": "~1.0"
}

```

Add the Bundle to your `app/AppKernel.php`:

```php
public function registerBundles()
{
    $bundles = array(
        // …
        new Tui/SessionBundle/TuiSessionBundle(),
    }
    // …
```

You can configure the timeout in your `app.yml` file:

```yaml
tui_session:
    session_timeout: 3600 # One hour
```

