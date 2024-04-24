<?php
namespace PageBlocks\Site\BlockLayout;

use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Laminas\Form\FormElementManager;
use Laminas\View\Renderer\PhpRenderer;
use PageBlocks\Form\ColumnLayoutForm;

class ColumnLayout extends AbstractBlockLayout
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
        return 'Column layout'; // @translate
    }

    public function prepareForm(PhpRenderer $view)
    {
        $view->headScript()->appendFile($view->assetUrl('js/column-layout.js', 'PageBlocks'));
        $view->headLink()->appendStylesheet($view->assetUrl('css/admin.css', 'PageBlocks'));
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $form = $this->formElementManager->get(ColumnLayoutForm::class);
            
        if ($block && $block->data()) {
            $form->populateValues([
                'o:block[__blockIndex__][o:data][header]' => $block->dataValue('header')
            ]);
        }
        
        return $view->formCollection($form) . $view->partial('common/admin/sidebar-list', [
            'headerText' => 'Columns', // @translate
            'addButtonText' => 'Add column', // @translate
            'sidebarId' => 'column',
            'groupKey' => 'columns',
            'labelField' => function ($values) {
                if ($values["type"] == 'html') {
                    return 'HTML content'; // @translate
                } else if ($values["type"] == 'asset') {
                    return 'Image asset'; // @translate
                } else if ($values["type"] == 'item') {
                    return 'Item media'; // @translate
                } else {
                    return '';
                }
            },
            'resourceFields' => [
                'asset' => 'asset',
                'item' => 'item'
            ],
            'keys' => [
                'type',
                'html',
                'asset',
                'item'
            ],
            'values' => $block ? $block->dataValue('columns') : []
        ]);
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        return $view->partial('common/block-layout/column-layout', [
            'header' => $block->dataValue('header'),
            'columns' => $block->dataValue('columns'),
        ]);
    }
}
?>