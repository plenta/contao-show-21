<?php

declare(strict_types=1);

namespace App\Controller\FrontendModule;

use App\Model\CarsModel;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous')]
class CarsController extends AbstractFrontendModuleController
{
    public function __construct(private readonly Studio $studio)
    {
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $cars = CarsModel::findAll();

        // Ohne Bildbehandlung
        //$template->set('cars', $cars ?: null);

        // Mit Bildbehandlung
        $items = [];

        if (null !== $cars) {
           foreach ($cars as $car) {
               $items[] = [
                   'marke' => $car->marke,
                   'baujahr' => $car->baujahr,
                   'image' => $this->studio
                       ->createFigureBuilder()
                       ->fromUuid($car->image ?: '')
                       ->setSize($model->imgSize)
                       ->buildIfResourceExists(),
               ];
           }
        }

        $template->set('cars', $items ?: null);

        return $template->getResponse();
    }
}
