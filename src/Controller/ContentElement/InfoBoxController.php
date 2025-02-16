<?php

declare(strict_types=1);

namespace App\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\String\HtmlAttributes;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'texts')]
class InfoBoxController extends AbstractContentElementController
{
    public function __construct(private readonly InsertTagParser $insertTagParser)
    {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $template->set('subHeadline', $model->subHeadline ?: '');
        $template->set('text', $model->text ?: '');

        // Link with attributes
        $href = $this->insertTagParser->replaceInline($model->url ?? '');

        if (Validator::isRelativeUrl($href)) {
            $href = $request->getBasePath().'/'.$href;
        }

        $linkAttributes = (new HtmlAttributes())
            ->set('href', $href)
            ->setIfExists('title', $model->titleText)
            ->setIfExists('data-lightbox', $model->rel)
        ;

        if ($model->target) {
            $linkAttributes
                ->set('target', '_blank')
                ->set('rel', 'noreferrer noopener')
            ;
        }

        $template->set('href', $href);
        $template->set('link_attributes', $linkAttributes);
        $template->set('link_text', $model->linkTitle ?: $href);

        return $template->getResponse();
    }
}
