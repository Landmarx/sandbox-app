#Landmarx Sandbox
##Geo-node mapping system





##Examples:
Create a new `LandmarkType`
    $mountain = new LandmarkType('mountain');
    // Child type
    $peak = new LandmarxType('peak');
    $peak->setParent($mountain);

Create a `Landmark`
    $katahdin = new Landmark('katahdin', $mountain, [45.904354, -68.921274]);
    // Child landmark
    $baxter = new Landmark('baxter', $peak, $katahdin->getCoordinates());
    $baxter->setParent($katahdin);
    // Inline
    $katahdin->addChild(new Landmark('hamlin', $peak, [45.921167, -68.923333]));

Attributes
    $katahdin->addAttribute('elevation', 5269);
    $baxter->addAttribute('elevation', 5269);
    $katahdin['hamlin']->addAttribute('elevation', 4756);
    
Location
    // Coords
    $lat = 45.921167;
    $lng = -68.923333;
    $coords = new Coordinates();
    $coords->setLatitude($lat)->setLongitude($lng);
    // Address
    $addy = new Address();
    $addy->setFullAddress("123 some street\nsomewhere, ME\n04001");