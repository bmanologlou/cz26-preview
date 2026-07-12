<?php
/**
 * News & Events seed data, ported verbatim from news.json.
 * Consumed by cz_import_news() in inc/import-content.php.
 *
 * `image` stays as the original external carbonzapp.com URL — the
 * importer sideloads it into the Media Library on import so the WP site
 * doesn't hotlink production assets going forward.
 *
 * A few event articles in the source data give only a month ("November
 * 2025") rather than an exact day for event_date, while still carrying a
 * precise event_end. Where that happens, event_start below is inferred as
 * the 1st of that month (noted per entry) purely so the homepage "Next
 * Appearance" sort has a machine-readable date to order by — the
 * human-facing event_date_display text is kept verbatim from the source.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cz_news_seed() {
	return array(

		'posidonia-2026' => array(
			'title'   => 'Posidonia 2026',
			'date'    => '2026-05-01',
			'excerpt' => 'Carbon Zapp will be present at Posidonia 2026 — Hall 1, Stand 1.215. The Next Standard for Marine Injection Service.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_Poseidonia-938x577w.png',
			'categories' => array( 'events' ),
			'body' => array(
				"Carbon Zapp will be present at Posidonia 2026, bringing advanced engineering expertise to one of the world's leading maritime exhibitions.",
				"The Next Standard for Marine Injection Service marks our focus for this year's presence: precision technologies engineered for marine power, large engine systems, and demanding operating conditions.",
				"Join us at Posidonia 2026 in Metropolitan Expo, Athens, from 01 to 5 June 2026. Visit us at Hall 1, Stand 1.215 and explore our latest diagnostic and service innovations engineered to power the future of Diesel and Gasoline systems.",
				"With 35+ years of innovation, a global network across 98 countries, a complete platform range, and OEM-trusted technology, Carbon Zapp continues to deliver Engineering Forward Mobility Solutions for professionals worldwide.",
				"Don't miss out! Book a meeting at sales@carbonzapp.com and explore the NEW CZ XSeries tailored to your workshop's needs.",
			),
			'event' => array(
				'date_display' => '01–05 June 2026',
				'start'        => '20260601',
				'end'          => '20260605',
				'location'     => 'Metropolitan Expo, Athens — Hall 1, Stand 1.215',
				'link'         => 'https://posidonia-events.com/',
			),
		),

		'ttm-poznan-2026' => array(
			'title'   => 'TTM Poznań 2026',
			'date'    => '2026-04-06',
			'excerpt' => 'Carbon Zapp, in collaboration with Gładysek sp.j., invites you to join us at TTM 2026, one of the key automotive industry events in Central and Eastern Europe.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_TTM-938x577w.png',
			'categories' => array( 'events' ),
			'body' => array(
				"Carbon Zapp, in collaboration with Gładysek sp.j., is pleased to invite you to join us at TTM 2026, one of the key automotive industry events in Central and Eastern Europe.",
				"From April 23 to April 26, 2026, the MTP Poznań Expo in Poznań, Poland will once again transform into a hub of innovation, technology, and next-generation automotive solutions, bringing together leading manufacturers, distributors, service providers, and industry decision-makers.",
				"Visit us at Hall 8A, Stand No. 25 to explore our latest advanced testing, calibration, and diagnostic technologies, including the NEW Carbon Zapp CZ XSeries, designed to enhance precision, efficiency, and overall performance for workshops, service centers, and automotive professionals.",
				"Book a meeting at sales@carbonzapp.com and discover the NEW CZ XSeries, tailored to meet your workshop's requirements.",
			),
			'event' => array(
				'date_display' => 'April 23–26, 2026',
				'start'        => '20260423',
				'end'          => '20260426',
				'location'     => 'MTP Poznań Expo, Poznań, Poland',
				'link'         => 'https://ttm.mtp.pl/en//',
			),
		),

		'hdaw-texas-2026' => array(
			'title'   => 'HDAW Texas 2026',
			'date'    => '2026-01-10',
			'excerpt' => 'Carbon Zapp, together with Williams Diesel Service and SRN-MI Srl, invites you to Heavy Duty Aftermarket Week 2026 in Grapevine, Texas.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_HDAW_Texas-938x577w.jpg',
			'categories' => array( 'events' ),
			'body' => array(
				"Carbon Zapp, together with Williams Diesel Service (WDS) and SRN-MI Srl, is excited to invite you to join us at Heavy Duty Aftermarket Week 2026, one of the most important industry events for the global heavy-duty market.",
				"From January 19 to January 22, 2026, the Gaylord Texan Resort & Convention Center will once again become the meeting point for innovation, technology, and future heavy-duty solutions.",
				"Visit us at Booth #1631 and experience our latest advanced testing, calibration, and diagnostic technologies, including the NEW CZ XSeries.",
			),
			'event' => array(
				'date_display' => 'January 19–22, 2026',
				'start'        => '20260119',
				'end'          => '20260122',
				'location'     => 'Gaylord Texan Resort & Convention Center, Grapevine, Texas, USA',
				'link'         => 'https://www.hdaw.org/',
			),
		),

		'automechanika-dubai-2025' => array(
			'title'   => 'Automechanika Dubai 2025',
			'date'    => '2025-12-01',
			'excerpt' => 'Carbon Zapp invites you to Automechanika Dubai 2025, the leading international trade fair for the automotive aftermarket in the Middle East.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_AUM_Dubai_25-600x315w.jpg',
			'categories' => array( 'events' ),
			'body' => array(
				"Carbon Zapp is excited to invite you to join us at Automechanika Dubai 2025, the leading international trade fair for the automotive aftermarket in the Middle East.",
				"From 9 to 11 December 2025, the Dubai World Trade Centre will once again become a global hub for technology, innovation and aftermarket solutions.",
				"Visit our stand to explore the latest CZ XSeries innovations.",
			),
			'event' => array(
				'date_display' => 'December 9–11, 2025',
				'start'        => '20251209',
				'end'          => '20251211',
				'location'     => 'Dubai World Trade Centre, Dubai, UAE',
				'link'         => 'https://automechanika-dubai.ae.messefrankfurt.com/dubai/en.html',
			),
		),

		'expotransporte-mexico-2025' => array(
			'title'   => 'Expotransporte Mexico 2025',
			'date'    => '2025-11-06',
			'excerpt' => "Carbon Zapp participates in Expotransporte Anpact 2025, Mexico's leading heavy transport and automotive trade show.",
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_MEXICO-600x315w.png',
			'categories' => array( 'events' ),
			'body' => array(
				"Carbon Zapp participates in Expotransporte Anpact 2025, Mexico's leading heavy transport and automotive trade show, showcasing the latest CZ XSeries innovations.",
			),
			'event' => array(
				// Source gives only a month ("November 2025"); start inferred as the 1st, see file header note.
				'date_display' => 'November 2025',
				'start'        => '20251101',
				'end'          => '20251108',
				'location'     => 'Mexico',
				'link'         => 'https://www.expotransporte.com.mx/',
			),
		),

		'automechanika-shanghai-2025' => array(
			'title'   => 'Automechanika Shanghai 2025',
			'date'    => '2025-11-01',
			'excerpt' => "Carbon Zapp joins Automechanika Shanghai 2025, Asia's largest trade fair for the automotive service industry.",
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_AMF_Shanghai_25-600x315w.jpg',
			'categories' => array( 'events' ),
			'body' => array(
				"Carbon Zapp joins Automechanika Shanghai 2025, Asia's largest trade fair for the automotive service industry, showcasing the CZ XSeries range.",
			),
			'event' => array(
				// Source gives only a month ("November 2025"); start inferred as the 1st, see file header note.
				'date_display' => 'November 2025',
				'start'        => '20251101',
				'end'          => '20251129',
				'location'     => 'Shanghai, China',
				'link'         => 'https://automechanika-shanghai.messefrankfurt.com/',
			),
		),

		'new-rsp-adapter-sensor' => array(
			'title'   => 'New CZ RSP Adapter & Sensor',
			'date'    => '2025-07-31',
			'excerpt' => 'Upgraded RSP Discharge Adapter & Sensor, now engineered for enhanced durability and simplified maintenance with a new modular construction.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_RSP-938x577w.png',
			'categories' => array( 'news', 'innovation' ),
			'body' => array(
				"We're excited to present the upgraded RSP Discharge Adapter & Sensor, now engineered for enhanced durability and simplified maintenance.",
				"The redesigned adapter has significantly reduced failure rates in demanding workshop environments. Thanks to its new modular construction, the sensing element can now be replaced independently — saving time and reducing service costs.",
				"This upgrade is fully compatible with all current CZ XSeries benches.",
			),
		),

		'cummins-xpi-injector-coding' => array(
			'title'   => 'New Cummins XPI Injector Coding Now Available',
			'date'    => '2025-05-19',
			'excerpt' => 'Carbon Zapp expands its coding library with full support for Cummins XPI injectors, available now via CloudX platform.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_XPI-938x577w.png',
			'categories' => array( 'news', 'innovation' ),
			'body' => array(
				"Carbon Zapp is pleased to announce the availability of Cummins XPI Injector Coding, now fully supported on the CZ XSeries platform.",
				"This new coding solution extends the CZ XSeries compatibility to cover one of the most widely used heavy-duty injector systems in North America and global markets.",
				"Available immediately via the CloudX platform for all registered CZ XSeries users.",
			),
		),

		'delphi-f2p-injector-coding' => array(
			'title'   => 'New Coding Release: Delphi F2P Injector EU6 for DAF Systems',
			'date'    => '2025-02-13',
			'excerpt' => 'Carbon Zapp releases new coding support for Delphi F2P EU6 injectors used in DAF truck systems, expanding XSeries compatibility.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_F2Pn-938x577w.png',
			'categories' => array( 'news', 'innovation' ),
			'body' => array(
				"Carbon Zapp announces the release of new coding support for Delphi F2P EU6 injectors used in DAF truck systems.",
				"This release further expands the CZ XSeries compatibility library, enabling specialists to service a broader range of heavy-duty vehicles with full precision and confidence.",
				"Update available now via the CloudX platform.",
			),
		),

		'tablet-retrofit-10inch' => array(
			'title'   => 'New 10" Tablet Retrofit for Your 8" Carbon Zapp Bench',
			'date'    => '2025-02-10',
			'excerpt' => 'Upgrade your existing 8-inch Carbon Zapp bench with the new 10-inch tablet retrofit kit for a larger, more responsive interface.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_Tablet-600x315w.png',
			'categories' => array( 'news', 'innovation' ),
			'body' => array(
				"Carbon Zapp introduces the new 10-inch Tablet Retrofit Kit, designed to upgrade existing 8-inch Carbon Zapp benches.",
				"The larger display delivers a more responsive, clearer interface for technicians, improving workflow efficiency in busy workshop environments.",
				"The retrofit kit is available through your authorized Carbon Zapp distributor.",
			),
		),

		'black-friday-2025' => array(
			'title'   => 'Unlock Exclusive Black Friday Discounts',
			'date'    => '2025-11-26',
			'excerpt' => 'Carbon Zapp Black Friday 2025 — exclusive discounts on CZ Credits and selected XSeries accessories. Limited time offer.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_Black_Friday_2025-01-600x315w.png',
			'categories' => array( 'news' ),
			'body' => array(
				"Carbon Zapp Black Friday 2025 is here. Take advantage of exclusive discounts on CZ Credits and selected XSeries accessories.",
				"Visit the Carbon Zapp store and unlock your Black Friday savings — limited time only.",
			),
		),

		'celebrating-35-years' => array(
			'title'   => 'Celebrating 35 Years of Innovation',
			'date'    => '2024-08-06',
			'excerpt' => 'Carbon Zapp celebrates 35 years of engineering excellence, precision innovation, and global impact in automotive injection service technology.',
			'image'   => 'https://carbonzapp.com/image/cache/catalog/CZ_EVENT_Celebrate_24-02-600x315w.png',
			'categories' => array( 'news' ),
			'body' => array(
				"Carbon Zapp proudly marks 35 years of engineering excellence and precision innovation in automotive injection service technology.",
				"Since 1989, we have been at the forefront of developing smarter, cleaner, and more efficient solutions for workshops and specialists worldwide.",
				"Thank you to our global network of partners, distributors, and customers who have been part of this journey.",
			),
		),

	);
}
