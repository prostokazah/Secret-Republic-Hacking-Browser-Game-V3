<?php

$faq_categories = $db->orderBy('faq_order', 'asc')->get('faq_categories');
$faq = $db->orderBy('faq_order', 'asc')->get('faq_questions');

foreach($faq as &$f)
{
  $f['answer'] = str_replace("WEBSITE_URL", configs('url'), $f['answer']);
}
$templateVariables['faq_categories'] = $faq_categories;
$templateVariables['faq'] = $faq;

$templateVariables['display'] = 'faq/faq.tpl';