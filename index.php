<?php

/*************************************************************************************
    Author: Mariah Garcia <mgarcia50@academic.rrc.ca>
    Description: Decode a JSON-based Open Data dataset using PHP
 *************************************************************************************/

// Stores json data into a variable and decodes 
$url = 'http://regionaldashboard.alberta.ca/export/opendata/Crop%20Acres/jsons';
$data = file_get_contents($url);
$crops = json_decode($data);

// Controls count of diplayed data
$count = 0;

// Returns proper function icon
function getIcon($icon)
{
    switch ($icon) {
        case "Barley":
            $icon_name = "fas fa-leaf";
            break;
        case "Canola":
            $icon_name = "fas fa-spa";
            break;
        default:
            $icon_name = "fab fa-pagelines";
            break;
    }

    echo $icon_name;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crop Acres of Alberta</title>
    <link rel="stylesheet" href="A5.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
    <div id="header">
        <h1>Explore the Croplands of Alberta</h1>
    </div>
    <div class="wrapper">
        <!--Only display the first 50 data-->
        <?php foreach ($crops as $crop) : ?>
            <?php if ($crop->OriginalValue > 0 && $count < 35) : ?>
                <div id="tile">
                    <h2><?= $crop->CSD ?> <br></h2>
                    <p><em>Year <?= $crop->Period ?></em></p>
                    <p><?= $crop->Dimensions[0]->Name ?>: <?= $crop->Dimensions[0]->Value ?> </p>
                    <p><?= $crop->OriginalValue . ' ' . $crop->UnitOfMeasure ?> <i class="<?php getIcon($crop->Dimensions[0]->Value) ?>"></i></p>
                </div>
                <?php $count++ ?>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</body>

</html>