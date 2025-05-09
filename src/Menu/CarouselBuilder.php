<?php
// src/Menu/CarouselBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class CarouselBuilder
{
private $factory;

public function __construct(FactoryInterface $factory)
{
$this->factory = $factory;
}

public function createCarousel(array $items): ItemInterface
{
$menu = $this->factory->createItem('carousel');

foreach ($items as $index => $item) {
$menu->addChild('slide_'.$index, [
'label' => $item['title'],
'attributes' => [
'class' => 'carousel-item' . ($index === 0 ? ' active' : ''),
'data-bs-interval' => $item['interval'] ?? 5000,
],
'extras' => [
'description' => $item['description'] ?? null,
'image' => $item['image'],
'link' => $item['link'] ?? '#',
],
]);
}

return $menu;
}
}