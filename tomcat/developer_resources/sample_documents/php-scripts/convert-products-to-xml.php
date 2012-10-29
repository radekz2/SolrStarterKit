<?php

$dtFileProducts = "../birt-database-2_0_1/ClassicModels/mysql/datafiles/Products.txt";

$dom = new DOMDocument('1.0', 'utf-8');

$products = $dom->createElement("products");

if (($handle = fopen($dtFileProducts, "r")) !== FALSE) 
{
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    {
        //ONLY USE PRODUCTS WHERE DATE CAN BE EXTRACTED
//        $year = substr($data[1], 0, 4);
//        if (!is_int($year))
//        {
//            continue;
//        }
        for ($i = 0; $i < count($data); $i++)
        {
            $data[$i] = utf8_encode($data[$i]);
        }
        
        $product = $dom->createElement("product");
                       
        $product->appendChild($dom->createElement("ProductCode", $data[0]));
        
        $val = $product->appendChild($dom->createElement("ProductName"));
        $val->appendChild($dom->createCDATASection($data[1]));
        $product->appendChild($dom->createElement("ProductLine", $data[2]));
        $product->appendChild($dom->createElement("ProductScale", $data[3]));
        $product->appendChild($dom->createElement("ProductVendor", $data[4]));
        $val = $product->appendChild($dom->createElement("ProductDescription"));
        $val->appendChild($dom->createCDATASection($data[5]));
        $product->appendChild($dom->createElement("QuantityInStock", $data[6]));
        $product->appendChild($dom->createElement("BuyPrice", $data[7]));
        $product->appendChild($dom->createElement("MSRP", $data[8]));
        
        $products->appendChild($product);
        
        //SAVE INDIVUDUAL FILES
        $dom2 = new DOMDocument('1.0', 'utf-8');
        $productsNode = $dom2->createElement("products");
        $node = $dom2->importNode($product, true);
        $productsNode->appendChild($node);
        $dom2->appendChild($productsNode);
        //$dom2Products = $dom->createElement("products");
        //$dom2Products->appendChild($dom->createTextNode($product->));
        $dom2->save("multiple/" . $data[0] . ".xml");
    }
    fclose($handle);
}

$dom->appendChild($products);

$dom->save("products.xml");