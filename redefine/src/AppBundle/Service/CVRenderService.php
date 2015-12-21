<?php

namespace AppBundle\Service;

use \Twig_Loader_Array;
use \Twig_Loader_Chain;

/**
 * CVRenderService
 *
 * @Service for rendering the CVs.
 */
class CVRenderService {

	protected $twig;
	protected $twigLocal;

    public function __construct(\Twig_Environment $twig) {
        $this->twig = $twig;
    }

	public function getTemplateHtml($cv) {
		$this->setBaseTemplate($cv->getTemplate()->getHtmlSource());
		// generate template
		$templateString = '{% extends \'base\' %}';
		foreach($cv->getTemplate()->getTemplateSlots() as $slot) {
			$templateString .= '{% block '.$slot->getWildcard().' %}';
			foreach ($slot->getBlockDatas() as $data) {
				$template = $this->twig->createTemplate($data->getBlock()->getHtmlSource());
				$templateString .= $template->render(json_decode($data->getData(), true));
			}
			$templateString .= '{% endblock %}';
		}

		$template = $this->twig->createTemplate($templateString);
		return $template->render(array(
			'text' => 'Fabien'
		));
	}

	protected function setBaseTemplate($templateString) {
		$loader1 = $this->twig->getLoader();
        $loader2 = new Twig_Loader_Array(array(
        	'base' => $templateString
		));
		$this->twig->setLoader(new Twig_Loader_Chain(array($loader1, $loader2)));
	}
}
