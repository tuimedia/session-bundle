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
    "tui/session-bundle": "~1.1"
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

## Redirecting on expiry

By default when the session expires, the listener will invalidate the session and throw a CredentialsExpired exception. Obviously it'd be much better to redirect the user to a "Login expired" page. Right now you can configure a route name to which the listener will redirect the user:

In your `app.yml` file:

```yaml
tui_session:
    redirect_route: login_expired
```

Alternatively you can create a custom response, register it as a service and configure it to be returned instead. A trivial example:

```yaml
tui_session:
    expired_response: session_expired

services:
    session_expired:
        class: Symfony\Component\HttpFoundation\Response
        arguments:
            - 'Your login expired, sorry!'
```
