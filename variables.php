<?php 

$id = isset($_GET['id']) ? $_GET['id'] : 1;

$products = [
'1' => [
    "id" => "1",
    "name" => "Laperva Iso Triple Zero Next Generation",
    "sizes" => ['5LB','2LB','4LB'],
    "flavors" => ['Belgian Chocolate','Belgian Strawberry','Belgian Toffee', 'Belgian Cookies and Cream', 'Chocolate Coconut','Banana'],
    "price" => 332.10,
    "oldPrice" => 369,
    ],
'2' =>[
        "id" => "2",
        "name" => "Laperva Iso Triple Zero Next Generation",
        "sizes" => ['5LB','2LB','4LB'],
        "flavors" => ['Strawberry','Mango Passion Fruit','Belgian Toffee', 'Belgian Cookies and Cream', 'Banana', 'Cafe Latte'],
        "price" => 352.10,
        "oldPrice" => 410,
],
'3' =>[
        "id" => "3",
        "name" => "Laperva Iso Triple Zero Next Generation",
        "sizes" => ['5LB','2LB','4LB'],
        "flavors" => ['Banana','Mango Passion Fruit','Belgian Toffee', 'Belgian Cookies and Cream', 'Strawberry', 'Pina Colada'],
        "price" => 295.60,
        "oldPrice" => 312,
    ]
];



$productName = $products[$id]['name'];
$productPrice = $products[$id]['price'];
$productOldPrice = $products[$id]['oldPrice'];
$productSize1 = $products[$id]['sizes'][0];
$productSize2 = $products[$id]['sizes'][1];
$productSize3 = $products[$id]['sizes'][2];
$productFlavor1 = $products[$id]['flavors'][0];
$productFlavor2 = $products[$id]['flavors'][1];
$productFlavor3 = $products[$id]['flavors'][2];
$productFlavor4 = $products[$id]['flavors'][3];
$productFlavor5 = $products[$id]['flavors'][4];
$productFlavor6 = $products[$id]['flavors'][5];
?>