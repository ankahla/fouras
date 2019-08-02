<?php
namespace UserBundle\Controller;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * abstract user Controller
 *
 * @author ankahla <kahla.anouar@yahoo.fr>
 */
Trait ControllerTrait
{
    public function createForm(string $type, $data = null, array $options = array()): FormInterface
    {
        return $this->get('form.factory')->create($type, $data, $options);
    }

    public function getRequest(): Request
    {
        return $this->get('request_stack')->getCurrentRequest();
    }
}
