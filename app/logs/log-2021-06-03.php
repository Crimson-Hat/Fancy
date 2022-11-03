<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-03 17:22:17 --> Query error: Table 'sma.sma_rax_rates' doesn't exist - Invalid query: SELECT sma_products.id as productid, sma_products.image as image, sma_products.code as code, sma_products.name as name, sma_brands.name as brand, sma_categories.name as cname, subcategory.name as scname, cost as cost, price as price, COALESCE(quantity, 0) as quantity, sma_units.code as unit, '' as rack, alert_quantity
FROM `sma_products`
LEFT JOIN `sma_categories` ON `sma_products`.`category_id`=`sma_categories`.`id`
LEFT JOIN `sma_categories` `subcategory` ON `sma_products`.`subcategory_id`=`sma_categories`.`id`
LEFT JOIN `sma_units` ON `sma_products`.`unit`=`sma_units`.`id`
LEFT JOIN `sma_brands` ON `sma_products`.`brand`=`sma_brands`.`id`
LEFT JOIN `sma_rax_rates` ON `sma_products`.`tax_rate`=`sma_tax_rate`.`id`
GROUP BY `sma_products`.`id`
ORDER BY `code` ASC, `name` ASC
 LIMIT 10
ERROR - 2021-06-03 17:22:26 --> Query error: Table 'sma.sma_rax_rates' doesn't exist - Invalid query: SELECT sma_products.id as productid, sma_products.image as image, sma_products.code as code, sma_products.name as name, sma_brands.name as brand, sma_categories.name as cname, subcategory.name as scname, cost as cost, price as price, COALESCE(quantity, 0) as quantity, sma_units.code as unit, '' as rack, alert_quantity
FROM `sma_products`
LEFT JOIN `sma_categories` ON `sma_products`.`category_id`=`sma_categories`.`id`
LEFT JOIN `sma_categories` `subcategory` ON `sma_products`.`subcategory_id`=`sma_categories`.`id`
LEFT JOIN `sma_units` ON `sma_products`.`unit`=`sma_units`.`id`
LEFT JOIN `sma_brands` ON `sma_products`.`brand`=`sma_brands`.`id`
LEFT JOIN `sma_rax_rates` ON `sma_products`.`tax_rate`=`sma_tax_rate`.`id`
GROUP BY `sma_products`.`id`
ORDER BY `code` ASC, `name` ASC
 LIMIT 10
ERROR - 2021-06-03 17:22:48 --> Query error: Unknown column 'sma_tax_rate.id' in 'on clause' - Invalid query: SELECT sma_products.id as productid, sma_products.image as image, sma_products.code as code, sma_products.name as name, sma_brands.name as brand, sma_categories.name as cname, subcategory.name as scname, cost as cost, price as price, COALESCE(quantity, 0) as quantity, sma_units.code as unit, '' as rack, alert_quantity
FROM `sma_products`
LEFT JOIN `sma_categories` ON `sma_products`.`category_id`=`sma_categories`.`id`
LEFT JOIN `sma_categories` `subcategory` ON `sma_products`.`subcategory_id`=`sma_categories`.`id`
LEFT JOIN `sma_units` ON `sma_products`.`unit`=`sma_units`.`id`
LEFT JOIN `sma_brands` ON `sma_products`.`brand`=`sma_brands`.`id`
LEFT JOIN `sma_tax_rates` ON `sma_products`.`tax_rate`=`sma_tax_rate`.`id`
GROUP BY `sma_products`.`id`
ORDER BY `code` ASC, `name` ASC
 LIMIT 10
ERROR - 2021-06-03 17:35:57 --> Could not find the language line "method"
ERROR - 2021-06-03 17:35:57 --> Could not find the language line "method"
ERROR - 2021-06-03 17:46:25 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-06-03 17:49:34 --> Query error: Unknown column 'sma_product.id' in 'field list' - Invalid query: SELECT sma_product.id as productid, sma_products.image as image, sma_products.code as code, sma_products.name as name, sma_brands.name as brand, sma_categories.name as cname, subcategory.name as scname, cost as cost, price as price, CONCAT(sma_tax_rates.rate, (CASE WHEN sma_tax_rates.type = 1 THEN '%' ELSE 'F' END)) as tax_rate, tax_method, COALESCE(quantity, 0) as quantity, sma_units.code as unit, '' as rack, alert_quantity
FROM `sma_products`
LEFT JOIN `sma_categories` ON `sma_products`.`category_id`=`sma_categories`.`id`
LEFT JOIN `sma_categories` `subcategory` ON `sma_products`.`subcategory_id`=`sma_categories`.`id`
LEFT JOIN `sma_units` ON `sma_products`.`unit`=`sma_units`.`id`
LEFT JOIN `sma_brands` ON `sma_products`.`brand`=`sma_brands`.`id`
LEFT JOIN `sma_tax_rates` ON `sma_products`.`tax_rate`=`sma_tax_rates`.`id`
GROUP BY `sma_products`.`id`
ORDER BY `code` ASC, `name` ASC
 LIMIT 10
ERROR - 2021-06-03 17:51:38 --> Severity: error --> Exception: Object of class CI_DB_mysqli_driver could not be converted to string /Users/saleem/Sites/sma/app/controllers/admin/Products.php 1550
ERROR - 2021-06-03 17:51:45 --> Severity: error --> Exception: Object of class CI_DB_mysqli_driver could not be converted to string /Users/saleem/Sites/sma/app/controllers/admin/Products.php 1550
ERROR - 2021-06-03 17:51:47 --> Severity: error --> Exception: Object of class CI_DB_mysqli_driver could not be converted to string /Users/saleem/Sites/sma/app/controllers/admin/Products.php 1550
