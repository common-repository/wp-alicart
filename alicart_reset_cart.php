<?php
$merchant_return_link = $_GET["merchant_return_link"];
if (!empty($merchant_return_link))
{
    alicart_reset_cart();
}
$mc_gross = $_GET["mc_gross"];
if ($mc_gross > 0)
{
    alicart_reset_cart();
}

function alicart_reset_cart()
{
    $products = $_SESSION['wpAlicart'];
    foreach ($products as $key => $item)
    {
        unset($products[$key]);
    }
    $_SESSION['wpAlicart'] = $products;
    header('地址：' . get_option('alipay_return_url'));
}

if ($_POST['alicart_addtocart'])
{
    $count = 1;    
    $products = $_SESSION['wpAlicart'];
    
    if (is_array($products))
    {
        foreach ($products as $key => $item)
        {
            if ($item['name'] == stripslashes($_POST['product']))
            {
                $count += $item['quantity'];
                $item['quantity']++;
                unset($products[$key]);
                array_push($products, $item);
            }
        }
    }
    else
    {
        $products = array();
    }
        
    if ($count == 1)
    {
        if (!empty($_POST[$_POST['product']]))
            $price = $_POST[$_POST['product']];
        else
            $price = $_POST['price'];
        
        $product = array('name' => stripslashes($_POST['product']), 'price' => $price, 'quantity' => $count, 'shipping' => $_POST['shipping'], 'alicart_cartlink' => $_POST['alicart_cartlink'], 'item_number' => $_POST['item_number']);
        array_push($products, $product);
    }
    
    sort($products);
    $_SESSION['wpAlicart'] = $products;
}
else if ($_POST['cquantity'])
{
    $products = $_SESSION['wpAlicart'];
    foreach ($products as $key => $item)
    {
        if ((stripslashes($item['name']) == stripslashes($_POST['product'])) && $_POST['quantity'])
        {
            $item['quantity'] = $_POST['quantity'];
            unset($products[$key]);
            array_push($products, $item);
        }
        else if (($item['name'] == stripslashes($_POST['product'])) && !$_POST['quantity'])
            unset($products[$key]);
    }
    sort($products);
    $_SESSION['wpAlicart'] = $products;
}
else if ($_POST['delcart'])
{
    $products = $_SESSION['wpAlicart'];
    foreach ($products as $key => $item)
    {
        if ($item['name'] == stripslashes($_POST['product']))
            unset($products[$key]);
    }
    $_SESSION['wpAlicart'] = $products;
}
else if ($_POST['clecart'])
{
    unset($_SESSION['wpAlicart']);
}
?>