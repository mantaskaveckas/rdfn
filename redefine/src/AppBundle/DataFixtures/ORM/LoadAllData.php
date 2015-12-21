<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Template;
use AppBundle\Entity\TemplateSlot;
use AppBundle\Entity\Block;
use AppBundle\Entity\User;
use AppBundle\Entity\CV;
use AppBundle\Entity\BlockData;

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
        $block1_1->setHtmlSource('<p>{{ text }}</p>');
        $block1_1->setAvailableFields(json_encode(array(
                'text'
            )));
        $manager->persist($block1_1);

        $block1_2 = new Block();
        $block1_2->setTitle('Text block with headline');
        $block1_2->setType(1);
        $block1_2->addTemplateSlot($templateSlot1_2);
        $block1_2->setHtmlSource('<h2>{{ headline }}</h2><p>{{ text }}</p>');
        $block1_2->setAvailableFields(
            json_encode(array(
                'headline',
                'text'
            )));
        $manager->persist($block1_2);

        $user1 = new User();
        $user1->setEmail('testinis.meska@example.com');
        $manager->persist($user1);

        $cv1 = new CV();
        $cv1->setUser($user1);
        $cv1->setTitle('My great red cv');
        $cv1->setUrl('my_great_red_cv');
        $cv1->setTemplate($template1);
        $manager->persist($cv1);

        $blockData1_1 = new BlockData();
        $blockData1_1->setCV($cv1);
        $blockData1_1->setTemplateSlot($templateSlot1_1);
        $blockData1_1->setBlock($block1_1);
        $blockData1_1->setData(json_encode(array(
                'text' => 'Mano CV pats geriausias ir gražiausias, todėl esu tinkamas betono nešiotojo darbams.'
            )));
        $manager->persist($blockData1_1);

        $blockData1_2 = new BlockData();
        $blockData1_2->setCV($cv1);
        $blockData1_2->setTemplateSlot($templateSlot1_1);
        $blockData1_2->setBlock($block1_1);
        $blockData1_2->setData(json_encode(array(
                'text' => 'Antras blockas į tą patį template slotą.'
            )));
        $manager->persist($blockData1_2);

        $manager->flush();
    }
}