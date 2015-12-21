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
		// all slots just replace the base template from Template.html_source
		$templateString = '{% extends \'base\' %}';
		// each TemaplteSlot acts as a block in parent template
		foreach($cv->getTemplate()->getTemplateSlots() as $slot) {
			$templateString .= '{% block '.$slot->getWildcard().' %}';
			// traverse through each slots blocks and fill it with data
			foreach ($slot->getBlockDatas() as $data) {
				$template = $this->twig->createTemplate($data->getBlock()->getHtmlSource());
				$parameters = json_decode($data->getData(), true);
				// if data has embedded child data, generate template for each of them and include in parent template
				if (count($data->getChildren()) > 0) {
					$childrenString = '';
					foreach ($data->getChildren() as $child) {
						$childTemplate = $this->twig->createTemplate($child->getBlock()->getHtmlSource());
						$childrenString .= $childTemplate->render(json_decode($child->getData(), true));
					}
					// if template is parent it must define 'blocks' variable where all children template will be inserted.
					$parameters['blocks'] = $childrenString;
				}
				$templateString .= ($template->render($parameters));
			}
			$templateString .= '{% endblock %}';
		}

		$template = $this->twig->createTemplate($templateString);
		return $template->render(array());
	}

	protected function setBaseTemplate($templateString) {
		$loader1 = $this->twig->getLoader();
        $loader2 = new Twig_Loader_Array(array(
        	'base' => $templateString
		));
		$this->twig->setLoader(new Twig_Loader_Chain(array($loader1, $loader2)));
	}
}
