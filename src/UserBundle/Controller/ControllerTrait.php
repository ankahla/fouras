<?php
namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * abstract user Controller
 *
 * @author ankahla <kahla.anouar@yahoo.fr>
 */
Trait ControllerTrait
{
    public function createForm($type, $data = null, array $options = array())
    {
        return $this->container->get('form.factory')->create($type, $data, $options);
    }

    public function getRequest(): Request
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }
}
