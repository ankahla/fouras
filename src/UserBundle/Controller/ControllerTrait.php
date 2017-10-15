<?php
namespace UserBundle\Controller;

/**
 * abstract user Controller
 *
 * @author ankahla <kahla.anouar@yahoo.fr>
 */
Trait ControllerTrait
{
	protected function render($tpl, $vars)
    {
        return $this->container->get('templating')->renderResponse($tpl, $vars);
    }

    public function createForm($type, $data = null, array $options = array())
    {
        return $this->container->get('form.factory')->create($type, $data, $options);
    }

    public function getRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }
}
