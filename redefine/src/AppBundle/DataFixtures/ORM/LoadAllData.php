<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Template;
use AppBundle\Entity\TemplateSlot;
use AppBundle\Entity\Block;

class LoadAllData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $template1 = new Template();
        $template1->setTitle('Red October');
        $template1->setHtmlSource('<html><head><title>Red October Template</title></head><body><h1>Red October Template</h1>{% block top_info %}{% endblock %}<hr/>{% block main_info %}{% endblock %}</body></html>');
        $manager->persist($template1);

        $templateSlot1_1 = new TemplateSlot();
        $templateSlot1_1->setTemplate($template1);
        $templateSlot1_1->setTitle('Top info slot');
        $templateSlot1_1->setWildcard('top_info');
        $manager->persist($templateSlot1_1);

        $templateSlot1_2 = new TemplateSlot();
        $templateSlot1_2->setTemplate($template1);
        $templateSlot1_2->setTitle('Main info slot');
        $templateSlot1_2->setWildcard('main_info');
        $manager->persist($templateSlot1_2);

        $block1_1 = new Block();
        $block1_1->setTitle('Text block');
        $block1_1->setType(1);
        $block1_1->addTemplateSlot($templateSlot1_1);
        $block1_1->addTemplateSlot($templateSlot1_2);
        $block1_1->setHtmlSource('<p>{{ text_value }}</p>');
        $block1_2->setAvailableFields('["text"]');
        $manager->persist($block1_1);

        $block1_2 = new Block();
        $block1_2->setTitle('Text block with headline');
        $block1_2->setType(1);
        $block1_2->addTemplateSlot($templateSlot1_2);
        $block1_2->setHtmlSource('<h2>{{ headline }}</h2><p>{{ text }}</p>');
        $block1_2->setAvailableFields('["headline","text"]');
        $manager->persist($block1_2);

        $manager->flush();
    }
}