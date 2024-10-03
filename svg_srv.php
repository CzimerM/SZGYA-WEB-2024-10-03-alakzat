<?php

function displayError()
{
    print("
    <svg viewBox=\"0 0 500 500'\" xmlns=\"http://www.w3.org/2000/svg\">
        <text x=\"15\" y=\"15\" fill=\"red\">Hibás leírás!</text>
    </svg>
    ");
    die();
}

header('Content-type: image/svg+xml');

$alakzat = isset($_GET["alakzat"]) ? $_GET["alakzat"] : "";
$fill = isset($_GET["fill"]) ? $_GET["fill"] : "";
$stroke = isset($_GET["stroke"]) ? $_GET["stroke"] : "";

if ( $alakzat == "" || $fill == "") displayError();

$svg_w = 500;
$svg_h = 500;

$svg = '<svg viewBox="0 0 ' . "{$svg_w} {$svg_h}" . '" xmlns="http://www.w3.org/2000/svg">';

switch($alakzat)
{
    case "circle":
        if (!isset($_GET["r"])) displayError();
        $r = intval($_GET["r"]);
        $cx = isset($_GET["cx"]) ? $_GET["cx"] : $svg_w / 2;
        $cy = isset($_GET["cy"]) ? $_GET["cy"] : $svg_h / 2;
        $svg .= '<circle cx="' . $cx . '" cy="' . $cy . '" r="' . $r . '" fill="' . $fill .'" stroke="'. $stroke . '"/>';
        break;
    case "ellipse":
        if (!isset($_GET["rx"]) || !isset($_GET["ry"])) displayError();
        $rx = intval($_GET["rx"]);
        $ry = intval($_GET["ry"]);
        $cx = isset($_GET["cx"]) ? $_GET["cx"] : $svg_w / 2;
        $cy = isset($_GET["cy"]) ? $_GET["cy"] : $svg_h / 2;
        $svg .= ' <ellipse cx="' . $cx . '" cy="' . $cy . '" rx="' . $rx . '" ry="' . $ry . '" fill="' . $fill .'" stroke="'. $stroke . '"/>';
        break;
    case "rect":
        if (!isset($_GET["width"]) || !isset($_GET["height"])) displayError();
        $width = intval($_GET["width"]);
        $height = intval($_GET["height"]);
        $svg .= '<rect x="' . ($svg_w - $width) / 2 . '" ' . 'y="' . ($svg_h - $height) / 2 . '" width="' . $width . '" height="' . $height . '" fill="' . $fill .'" stroke="'. $stroke . '"/>';
        break;
}

$svg .= "</svg>";
print($svg);
?>