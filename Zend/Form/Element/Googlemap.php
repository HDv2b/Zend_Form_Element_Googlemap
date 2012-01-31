<?
/**
 * Googlemap form element
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 */
class Zend_Form_Element_Googlemap extends Zend_Form_Element
{
    const SINGLE = 1;
    
    /**
     * Use FormGooglemap view helper by default
     * @var string
     */
    public $helper = 'FormGooglemap';
    
    public $key = "";
    public $zoom = 5;
    public $width = "400px";
    public $height = "400px";
    public $mode = SINGLE;
    public $center = "0,0";
    
    /**
     *
     * @param string $key Google Maps API Key
     * @return Zend_Form_Element_Googlemap 
     */
    public function setAPIKey($key){
        $this->key = $key;
        return $this;
    }
    
    /**
     *
     * @param int $zoom=5 zoom level for the map
     * @return Zend_Form_Element_Googlemap 
     */
    public function setZoom($z)
    {
        $this->zoom = $z;
        return $this;
    }
    
    /**
     *
     * @param int|string $w width for the map, pixels by default, % if % is used in string
     * @param int|string $h height for the map, pixels by default, % if % is used in string
     * @return Zend_Form_Element_Googlemap 
     */
    public function setDimensions($w,$h)
    {
        if(is_int($w)){
            $w.="px";
        }
        if(is_int($h)){
            $h.="px";
        }
        
        $this->width = $w;
        $this->height = $h;
        return $this;
    }
    
    /**
     *
     * @param int|string $x
     * @param int $y
     * @return Zend_Form_Element_Googlemap 
     * 
     * single parameter: Google latlng string
     * two parameters: x (latitude) and y (longtitude) coordinates.
     */
    public function setCenter($x,$y=false)
    {
        $y ? $this->center = "$x,$y" : $this->center = $x;
        return $this;
    }
    
    /**
     *
     * @param const $m
     * @return Zend_Form_Element_Googlemap 
     * 
     * Not implemented yet. Plan to be a mode selector for single input, multiple input, polygons, etc.
     */
    public function setMode($m)
    {
        $this->mode = $m;
        return $this;
    }

}
?>