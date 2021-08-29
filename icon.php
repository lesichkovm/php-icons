<?php

function icon(string $iconName, array $options = []) {
    $width = $options['width'] ?? '16';
    $height = $options['height'] ?? '16';
    $fill = $options['$fill'] ?? 'currentColor';
    $class = ($class ?? '');
    $onclick = $options['onclick'] ?? '';

    $attributes = [
        'width' => $width,
        'height' => $height,
        'fill' => $fill,
        'class' => $class,
        'viewbox' => '0 0 ' . $width . ' ' . $height,
    ];
    if ($onclick != "") {
        $attributes['onclick'] = $onclick;
    }
    $iconPath = __DIR__ . '/' . $iconName . '.svg';
    if (file_exists($iconPath) == false) {
        return $iconPath;
    }
    
    $icon = file_get_contents($iconPath);
    
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($icon);
    $tags = $doc->getElementsByTagName('svg');
    foreach ($tags as $tag) {
        foreach ($attributes as $key => $value) {
            $tag->setAttribute($key, $value);
        }
    }
    return $doc->saveHTML();
}
