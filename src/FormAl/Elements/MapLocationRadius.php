<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class MapLocationRadius
 *
 * @package FormAl\Elements
 */
class MapLocationRadius extends ElementBase
{
    /** @var string */
    private $labelname = "";
    /** @var float */
    private $locationLat = 0;
    /** @var float */
    private $locationLng = 0;
    /** @var null|int */
    private $radius = null;

    /**
     * @param string                                       $name
     * @param boolean                                      $radius Whether a radius should be displayed.
     * @param \FormAl\FormAlAbstract $formal
     */
    public function __construct($name, $radius, $formal)
    {
        $this->locationLat = \Config::$MUNICIPALITY_DEFAULT_LAT;
        $this->locationLng = \Config::$MUNICIPALITY_DEFAULT_LNG;
        if ($radius) {
            $this->radius = \Config::$MUNICIPALITY_DEFAULT_RADIUS;
        }

        parent::__construct($name, $formal);
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function label($text)
    {
        $this->labelname = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->labelname;
    }

    /**
     * @param float $locationLat
     * @param float $locationLng
     * @param int   $radius
     */
    public function setValues($locationLat, $locationLng, $radius = 1)
    {
        $this->locationLat = $locationLat;
        $this->locationLng = $locationLng;
        $this->radius = $radius;
    }

    public function setValuesFromPost()
    {
        if (isset($_POST['location_lat'])) {
            $this->locationLat = $_POST['location_lat'];
        }
        if (isset($_POST['location_lng'])) {
            $this->locationLng = $_POST['location_lng'];
        }
        if (isset($_POST['radius'])) {
            $this->radius = $_POST['radius'];
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $this->setValuesFromPost();
        $html = '';

        $element = new HtmlBuilder('script');
        $element->attr('type', 'text/javascript')
            ->attr(
                'src',
                'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places'
            );
        $html .= $element->render();

        $element = new HtmlBuilder('script');
        $element->attr('type', 'text/javascript')
            ->attr('src', EXT_TPL_ROOT . 'js/maplocationradius.js');
        $html .= $element->render();

        $element = new HtmlBuilder('input');
        $element->attr('type', 'text')
            ->attr('id', 'mapAddress')
            ->attr('placeholder', trans('Address'));
        $html .= $element->render();

        $element = new HtmlBuilder('div');
        $element->attr('id', 'mapCanvas');
        $html .= $element->render();

        $element = new HtmlBuilder('div');
        $element->attr('id', 'latitude');
        $input = $element->add('input');
        $input->attr('type', 'text')
            ->attr('readonly', 'readonly')
            ->attr('class', 'form-control')
            ->attr('id', 'latitudeInput')
            ->attr('name', 'location_lat')
            ->attr('value', $this->locationLat);
        $html .= $element->render();

        $element = new HtmlBuilder('div');
        $element->attr('id', 'longitude');
        $input = $element->add('input');
        $input->attr('type', 'text')
            ->attr('readonly', 'readonly')
            ->attr('class', 'form-control')
            ->attr('id', 'longitudeInput')
            ->attr('name', 'location_lng')
            ->attr('value', $this->locationLng);
        $html .= $element->render();

        if ($this->radius !== null) {
            $element = new HtmlBuilder('div');
            $element->attr('id', 'radius');
            $lbl = $element->add('label');
            $lbl->attr('for', 'radiusInput')
                ->addText(trans('Radius (meters):'));
            $div = $element->add('div');
            $input = $div->add('input');
            $input->attr('type', 'text')
                ->attr('class', 'form-control')
                ->attr('id', 'radiusInput')
                ->attr('name', 'radius')
                ->attr('onchange', 'updateCircle()')
                ->attr('onkeyup', 'this.onchange()')
                ->attr('value', $this->radius);
            $html .= $element->render();
        }

        return $html;
    }
}
