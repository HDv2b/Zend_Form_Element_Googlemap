<?php
require_once 'Zend/View/Helper/FormElement.php';

class Zend_View_Helper_FormGooglemap extends Zend_View_Helper_FormElement {
    const SINGLE = 1;
    public function FormGooglemap($name, $value = null, $attribs = null) {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, zoom
        extract($attribs);
        
        $script = "";
        $functions = "";
        
        if($value){
            $script .= <<<SCRIPT1
            marker = new google.maps.Marker({
                position: new google.maps.LatLng($value),
                map: map,
                draggable: false
            });
            $("#$name").val($value);
SCRIPT1;
        }
        
        if($mode == SINGLE){
            if(!$value){
                $script .= "var marker = false;";
            }
            $script .= <<<SCRIPT1
                google.maps.event.addListener(map, 'click', function(event) {
                    if(!marker){
                        marker = new google.maps.Marker({
                            position: event.latLng,
                            map: map,
                            draggable: false
                        });
                    }else{
                        marker.setPosition(event.latLng);
                    }
                    $("#$name").val(event.latLng.lat()+","+event.latLng.lng());
                });
SCRIPT1;

        }
        
        $html = <<<HTML
            <input type="hidden" name="$name" id="$name" />
            <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=$key&sensor=true">
            </script>
            <script type="text/javascript">
            $(document).ready(function() {
                if ($("#map_canvas").length != 0) {
                    var myOptions = {
                      center: new google.maps.LatLng($center),
                      zoom: $zoom,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
                    $script
                }
            });
            
            </script>
            <div id="map_canvas" style="width:$width; height:$height"></div>
HTML;
        
        return $html;
    }
}

?>
