# Tui SessionBundle

Adds a listener that expires user sessions after a configurable period of inactivity.

## Installation

Add this require reference to your `composer.json`:

```sh
php composer.phar require tui/session-bundle:~1.1
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

You can configure the timeout in your `config.yml` file:

```yaml
tui_session:
    session_timeout: 3600 # One hour
```

## Redirecting on expiry

By default when the session expires, the listener will invalidate the session and throw a CredentialsExpired exception. Obviously it'd be much better to redirect the user to a "Login expired" page. There are two ways you can do that:


### Redirect to a route

The listener can redirect to a given route when the session expires. This is super easy, but not very flexible. In your `config.yml` file:

```yaml
tui_session:
    redirect_route: login_expired
```

### Return a custom response

Alternatively you can create a custom response, register it as a service and configure it to be returned instead. Here's a trivial example that uses the built-in response class.

```yaml
tui_session:
    expired_response: session_expired

services:
    session_expired:
        class: Symfony\Component\HttpFoundation\Response
        arguments:
            - 'Your login expired, sorry!'
```

