<?php
namespace PageBlocksRM\Site\BlockLayout;

use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Laminas\Form\FormElementManager;
use Laminas\View\Renderer\PhpRenderer;
use PageBlocksRM\Form\MediaSingleSquareForm;

class MediaSingleSquare extends AbstractBlockLayout
{
    /**
     * @var FormElementManager
     */
    protected $formElementManager;
    
    /**
     * @param FormElementManager $formElementManager
     */
    public function __construct(FormElementManager $formElementManager)
    {
        $this->formElementManager = $formElementManager;
    }
    
    public function getLabel()
    {
        return 'RM Media Square + single column'; // @translate
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $form = $this->formElementManager->get(MediaSingleSquareForm::class);
            
        if ($block && $block->data()) {
            $form->setData([
                'o:block[__blockIndex__][o:data][html]' => $block->dataValue('html')
            ]);
        }
        
        $html = $view->blockAttachmentsForm($block);
        $html .= '<a href="#" class="collapse" aria-label="collapse"><h4>' . $view->translate('Content') . '</h4></a>';
        $html .= '<div class="collapsible">';
        $html .= $view->formCollection($form);
        $html .= '</div>';
        
        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        return $view->partial('common/block-layout/media-single-square', [
            'html' => $block->dataValue('html'),
            'attachments' => $block->attachments()
        ]);
    }
}
?>