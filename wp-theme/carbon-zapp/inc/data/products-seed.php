<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once __DIR__ . '/products-seed-part1.php';
require_once __DIR__ . '/products-seed-part2.php';

function cz_products_seed() {
	return array_merge( cz_products_seed_part1(), cz_products_seed_part2() );
}
