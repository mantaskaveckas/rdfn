<?php

namespace AppBundle\Service;

/**
 * CVRenderService
 *
 * @Service for rendering the CVs.
 */
class CVRenderService
{
	public function render($cv) {
		$template = $cv->getTemplate();

		return $template->getHtmlSource();
	}
}
