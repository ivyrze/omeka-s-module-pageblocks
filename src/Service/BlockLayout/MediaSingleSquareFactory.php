<?php
namespace PageBlocksRM\Service\BlockLayout;

use Interop\Container\ContainerInterface;
use PageBlocksRM\Site\BlockLayout\MediaSingleSquare;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MediaSingleSquareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new MediaSingleSquare(
            $services->get('FormElementManager'));
    }
}
?>