<?php declare(strict_types=1);

namespace PageBlocksRM;

return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ]
    ],
    'block_layouts' => [
        'factories' => [
            'media-single-square' => Service\BlockLayout\MediaSingleSquareFactory::class,
            'topics-list' => Service\BlockLayout\TopicsListFactory::class
        ],
    ],
    'form_elements' => [
        'invokables' => [
            Form\MediaSingleSquareForm::class => Form\MediaSingleSquareForm::class,
            Form\TopicsListSidebarForm::class => Form\TopicsListSidebarForm::class
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'sidebar' => Service\View\Helper\SidebarViewHelperFactory::class
        ]
    ]
];

?>