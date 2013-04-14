<?php
namespace Tui\SessionBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;

/**
 * Expires the session if idle too long
 */
class SessionExpiryListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        // Only operate on the master request
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $request = $event->getRequest();
        if (!$request->hasSession()) {
            return;
        }

        $session = $request->getSession();
        $session->start();
        $session_data = $session->getMetadataBag();

        // Expire sessions if unused for $idletimeout
        $idle_timeout = $this->container->getParameter('tui_session.session_timeout');
        if (time() - $session_data->getLastUsed() > $idle_timeout) {
            $session->invalidate();
            throw new CredentialsExpiredException(); // redirect to expired session page
        }

    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array('onKernelRequest', 127),
        );
    }
}
