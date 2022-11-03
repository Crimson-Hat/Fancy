<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-04 16:48:16 --> Query error: Unknown column 'sma_categorie.id' in 'field list' - Invalid query: SELECT sma_categorie.id as cid, sma_categories.code, sma_categories.name, SUM( COALESCE( PCosts.purchasedQty, 0 ) ) as PurchasedQty, SUM( COALESCE( PSales.soldQty, 0 ) ) as SoldQty, SUM( COALESCE( PCosts.totalPurchase, 0 ) ) as TotalPurchase, SUM( COALESCE( PSales.totalSale, 0 ) ) as TotalSales, (SUM( COALESCE( PSales.totalSale, 0 ) )- SUM( COALESCE( PCosts.totalPurchase, 0 ) ) ) as Profit
FROM `sma_categories`
LEFT JOIN ( SELECT sp.category_id as category, SUM( si.quantity ) soldQty, SUM( si.subtotal ) totalSale from sma_products sp
                left JOIN sma_sale_items si ON sp.id = si.product_id
                left join sma_sales s ON s.id = si.sale_id  GROUP BY sp.category_id ) PSales ON `sma_categories`.`id` = `PSales`.`category`
LEFT JOIN ( SELECT pp.category_id as category, SUM( pi.quantity ) purchasedQty, SUM( pi.subtotal ) totalPurchase from sma_products pp
                left JOIN sma_purchase_items pi ON pp.id = pi.product_id
                left join sma_purchases p ON p.id = pi.purchase_id  GROUP BY pp.category_id ) PCosts ON `sma_categories`.`id` = `PCosts`.`category`
WHERE parent_id is NULL
GROUP BY `sma_categories`.`id`, `sma_categories`.`code`, `sma_categories`.`name`, `PSales`.`SoldQty`, `PSales`.`totalSale`, `PCosts`.`purchasedQty`, `PCosts`.`totalPurchase`
ORDER BY `sma_categories`.`code` ASC
 LIMIT 10
