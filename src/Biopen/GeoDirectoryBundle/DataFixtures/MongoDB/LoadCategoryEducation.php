<?php

/**
 * This file is part of the MonVoisinFaitDuBio project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2016 Sebastian Castro - 90scastro@gmail.com
 * @license    MIT License
 * @Last Modified time: 2017-04-29 08:53:11
 */
 

namespace Biopen\GeoDirectoryBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Biopen\GeoDirectoryBundle\Document\Category;
use Biopen\GeoDirectoryBundle\Document\Option;

function loadEducation($mainOption, $c, $s)
{
	// AGRICULTURE
		$typeCategory = new Category();
		$typeCategory->setName('Structures');
		$typeCategory->setPickingOptionText('Une structure');
		$typeCategory->setIndex(0);
		$typeCategory->setSingleOption(false);
		$typeCategory->setEnableDescription(false);
		$typeCategory->setDisplayCategoryName(true);
		$typeCategory->setDepth(1);

		// Liste des noms de catégorie à ajouter
		$types = array(			
			array('Ecole'      				, 'icon-school'     		, 'brown',''				, true),
			array('Association'   			,''      						, 'darkblue',''        , false)
		);

		foreach ($types as $key => $type) 
		{
			$new_type = new Option();
			$new_type->setName($type[0]);

			$new_type->setIcon($type[1]);
			$new_type->setColor($c[$type[2]]);
			$new_type->setSoftColor($s[$type[2]]);
			$new_type->setTextHelper($type[3]);

			$new_type->setNameShort($type[0]);

			$new_type->setUseIconForMarker($type[4]);
			$new_type->setUseColorForMarker(true);

			$new_type->setIndex($key);
			$new_type->setShowSubcategories(!$type[4]);

			$typeCategory->addOption($new_type);
		}



		// CIRCUIT court détail
		$ecoleCategory = new Category();
		$ecoleCategory->setName('secteur');
		$ecoleCategory->setPickingOptionText('Un secteur');
		$ecoleCategory->setIndex(1);
		$ecoleCategory->setSingleOption(false);
		$ecoleCategory->setEnableDescription(false);
		$ecoleCategory->setDisplayCategoryName(false);
		$ecoleCategory->setDepth(2);

		// Liste des names de catégorie à ajouter
		$circuitCourtType = array(
			array('Maternelle'     , 'icon-angle-right'    , '', ''        , ''),
			array('Elementaire'   , 'icon-angle-right'    , '',''        , ''),
			array('Collège'     , 'icon-angle-right'    , '', ''        , ''),
			array('Lycée'        , 'icon-angle-right'    , '',''        , '')
		);

		foreach ($circuitCourtType as $key => $circuit) 
		{
			$new_circuit = new Option();
			$new_circuit->setName($circuit[0]);

			$new_circuit->setIcon($circuit[1]);
			$new_circuit->setColor($circuit[2]);
			$new_circuit->setSoftColor($circuit[2]);

			if ($circuit[3] == '') $new_circuit->setNameShort($circuit[0]);
			else $new_circuit->setNameShort($circuit[3]);

			$new_circuit->setTextHelper($circuit[4]);

			$new_circuit->setUseIconForMarker(false);
			$new_circuit->setUseColorForMarker(false);

			$new_circuit->setIndex($key);

			$ecoleCategory->addOption($new_circuit);
		}

		$serviceCategory = new Category();
		$serviceCategory->setName('Services');
		$serviceCategory->setPickingOptionText('Un service');
		$serviceCategory->setIndex(1);
		$serviceCategory->setSingleOption(false);
		$serviceCategory->setEnableDescription(true);
		$serviceCategory->setDisplayCategoryName(false);
		$serviceCategory->setDepth(2);

		// Liste des names de catégorie à ajouter
		$services = array(
			array('Animation'             , 'icon-echange-1'      , 'darkblue', ''        , ''),
			array('Formation'             , 'icon-formation-2'   , 'darkblue',''        , ''),
			array('Conférence'  				, 'icon-conf'     		, 'darkblue',''         , ''),
			array('Ateliers'              , 'icon-atelier-1'      , 'darkblue',''        , '')
		);

		foreach ($services as $key => $service) 
		{
			$new_service = new Option();
			$new_service->setName($service[0]);

			$new_service->setIcon($service[1]);
			$new_service->setColor($c[$service[2]]);
			$new_service->setSoftColor($s[$service[2]]);

			if ($service[3] == '') $new_service->setNameShort($service[0]);
			else $new_service->setNameShort($service[3]);

			$new_service->setTextHelper($service[4]);

			$new_service->setUseIconForMarker(true);
			$new_service->setUseColorForMarker(false);

			$new_service->setIndex($key);

			$serviceCategory->addOption($new_service);
		}

		// COMPILE
		$typeCategory->getOptions()[0]->addSubcategory($ecoleCategory);
		$typeCategory->getOptions()[1]->addSubcategory($serviceCategory);
		$mainOption->addSubcategory($typeCategory);
}