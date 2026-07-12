<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function cz_products_seed_part2() {
	return array(

		'gs4' => array(
			'title'               => 'GS4',
			'category_label'      => 'Gasoline 4-Channel Service Station',
			'tagline'             => 'Compact Gasoline Injector Service Solution',
			'market'              => 'workshops',
			'authorized'          => false,
			'actuator_tags'       => array( 'efi' ),
			'hero_slides'         => array(
				'images/cz_gs4_slider_01.webp',
				'images/cz_gs4_slider_02.webp',
			),
			'key_capabilities'    => array(
				'Ultrasonic Cleaning',
				'Up to 4 Injectors',
				'Conventional & Direct Injection Systems',
				'Dynamic & Static Testing',
				'Conventional & Direct Injection Systems',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/workshops/gs4-20',
			'brochure_pdf'        => 'pdfs/CZ_GASOLINE_WORKSHOP_GS4.pdf',
			'card_image'          => 'images/All_Machine_Workshops_800x800_01_GS4.webp',
			'card_description'    => 'Gasoline 4-Channel Service Station.',
			'card_bg'             => 'none',
			'sections'            => array(),
		),

		'gs8' => array(
			'title'               => 'GS8',
			'category_label'      => 'Gasoline 8-Channel Service Station',
			'tagline'             => 'Gasoline Injector Service Solution',
			'market'              => 'workshops',
			'authorized'          => false,
			'actuator_tags'       => array( 'efi' ),
			'hero_slides'         => array(
				'images/cz_gs8_slider_01.webp',
				'images/cz_gs8_slider_02.webp',
			),
			'key_capabilities'    => array(
				'Ultrasonic Cleaning',
				'Up to 8 Injectors',
				'Conventional & Direct Injection Systems',
				'Dynamic & Static Testing',
				'Conventional & Direct Injection Systems',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/workshops/gs8-20',
			'brochure_pdf'        => 'pdfs/CZ_GASOLINE_WORKSHOP_GS8.pdf',
			'card_image'          => 'images/All_Machine_Workshops_800x800_01_GS8.webp',
			'card_description'    => 'Gasoline 8-Channel Service Station.',
			'card_bg'             => 'none',
			'sections'            => array(),
		),

		'gtb4rx' => array(
			'title'               => 'GTB4R-X',
			'category_label'      => 'Gasoline 4-Rail Test Bench',
			'tagline'             => 'Professional GDi Testing Solution',
			'market'              => 'specialists',
			'authorized'          => false,
			'actuator_tags'       => array( 'gdi-inj', 'efi' ),
			'hero_slides'         => array(
				'images/cz_gtb4rx_slider_01.webp',
				'images/cz_gtb4rx_slider_02.webp',
			),
			'key_capabilities'    => array(
				'GDi Injector Testing',
				'Coding & Servicing',
				'Gasoline Injection Diagnostics',
				'EU6 Technologies Support',
				'Gasoline Injection Diagnostics',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/specialists/gtb-4rx-w',
			'brochure_pdf'        => 'pdfs/CZ_GASOLINE_SPECIALIST_GTB4RX.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_GTB4RX.webp',
			'card_description'    => 'Gasoline 4-Rail Test Bench. GDi + EFi.',
			'card_bg'             => 'none',
			'sections'            => array(),
		),

		'htbrx' => array(
			'title'               => 'HTBR-X',
			'category_label'      => 'HEUI & Engine Diagnostic Bench',
			'tagline'             => 'Professional HEUI Testing Solution',
			'market'              => 'specialists',
			'authorized'          => false,
			'actuator_tags'       => array( 'heui', 'engine' ),
			'hero_slides'         => array(
				'images/cz_htbrx_slider_01.webp',
				'images/cz_htbrx_slider_02.webp',
			),
			'key_capabilities'    => array(
				'HEUI Injector Testing',
				'Dynamic Overflow Measurement',
				'Coding Capabilities',
				'Up to 400 Bar',
				'Coding Capabilities',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/specialists/htbrx-w',
			'brochure_pdf'        => 'pdfs/CZ_DIESEL_SPECIALIST_HTBRX.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_HTBRX.webp',
			'card_description'    => 'HEUI & Engine Diagnostic Bench.',
			'card_bg'             => 'blue',
			'sections'            => array(),
		),

		'itb1rx' => array(
			'title'               => 'ITB1R-X',
			'category_label'      => 'Single CRDi Injector Test Bench',
			'tagline'             => 'Professional 1-Injector CRDi Testing Solution',
			'market'              => 'specialists',
			'authorized'          => true,
			'actuator_tags'       => array( 'crdi' ),
			'hero_slides'         => array(
				'images/cz_itb1rx_slider_01.webp',
				'images/cz_itb1rx_slider_02.webp',
			),
			'key_capabilities'    => array(
				'CRDi Injector Testing',
				'1 Injector Testing Slot',
				'Coding & Diagnostics',
				'Continental/VDO Authorized',
				'Up to 2800 Bar',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/specialists/itb-4rx-a',
			'brochure_pdf'        => 'pdfs/CZ_DIESEL_SPECIALIST_ITB1RX.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_ITB1RX.webp',
			'card_description'    => 'Single CRDi Injector Test Bench.',
			'card_bg'             => 'blue',
			'sections'            => array(),
		),

		'itb4rx' => array(
			'title'               => 'ITB4R-X',
			'category_label'      => 'Standalone CRDi Injector Test Bench',
			'tagline'             => 'Professional 4-Injector CRDi Testing Solution',
			'market'              => 'specialists',
			'authorized'          => true,
			'actuator_tags'       => array( 'crdi' ),
			'hero_slides'         => array(
				'images/cz_itb4rx_slider_01.webp',
				'images/cz_itb4rx_slider_02.webp',
			),
			'key_capabilities'    => array(
				'CRDi Injector Testing',
				'4 Injector Testing Slots',
				'Coding & Diagnostics',
				'Continental/VDO Authorized',
				'Up to 2800 Bar',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/specialists/itb-4rx-w',
			'brochure_pdf'        => 'pdfs/CZ_DIESEL_SPECIALIST_ITB4RX.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_ITB4RX.webp',
			'card_description'    => 'Standalone CRDi Injector Test Bench.',
			'card_bg'             => 'blue',
			'sections'            => array(),
		),

		'ltbrx' => array(
			'title'               => 'LTBR-X',
			'category_label'      => 'Large Engines Diesel Test Bench',
			'tagline'             => 'The flagship benchmark for Heavy-Duty and Large Engine Diesel diagnostics. Built for the industries that never stop. Shipping, Marine, Gensets, HD Engines, Machinery, Locomotives, Mining.',
			'market'              => 'specialists',
			'authorized'          => true,
			'actuator_tags'       => array( 'eui-eup', 'heui' ),
			'hero_slides'         => array(
				'images/LTBRX_Hero_S1.webp',
				'images/LTBRX_Slidern_S3_new_rrd2.webp',
				'images/LTBRX_Slidern_S2_new_rrd2.webp',
				'images/LTBRX_Hero_S4.webp',
			),
			'key_capabilities'    => array(
				'3,000+ Bar High-Pressure Capability',
				'45 kW / 60 HP Drive Power Rigs',
				'Supports 2-Stroke & 4-Stroke Diesel',
				'Advanced AZO Diagnostic Software',
				'11,000+ Part Numbers via CloudX',
			),
			// No intro_disclaimer for LTBR-X — flagship product, key intentionally omitted.
			'product_details_url' => 'https://carbonzapp.com/specialists/ltbrx-w',
			// Source href points to a non-existent "CZ_DIESEL_SPECIALIST_LTBRX.pdf" (broken
			// link in the original site); the file that actually exists on disk is the
			// "_com" variant below, so that's what we point to here.
			'brochure_pdf'        => 'pdfs/CZ_DIESEL_SPECIALIST_LTBRX_com.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_LTBRX.webp',
			'card_description'    => 'Large Injector Test Bench. EUI, EUP, HEUI.',
			'card_bg'             => 'blue',
			'sections'            => array(

				array(
					'type'          => 'content_block',
					'eyebrow'       => 'Product Overview',
					'heading'       => 'Engineered for Large Engine Specialists',
					'body'          => '<p>The LTBR-X is a standalone Heavy-Duty and Large Engine Diesel Test Bench designed for professionals who require uncompromising precision in fuel system diagnostics and maintenance.</p><p>Developed to support modern 2-stroke and 4-stroke diesel engines, including conventional, electronic and dual-fuel systems, it delivers stable and reliable performance across marine, locomotive, generator and heavy industrial applications.</p><p>Built on Carbon Zapp&#8217;s engineering expertise, the LTBR-X integrates advanced hardware architecture with AZO software control and CloudX connectivity.</p>',
					'list_style'    => 'dot',
					'list_title'    => 'Coverage includes',
					'list_items'    => array(
						'Cummins',
						'Caterpillar',
						'MAN Energy Solutions',
						'Rolls-Royce MTU',
						'Wärtsilä',
						'Mitsubishi Heavy Industries',
						'Volvo Penta',
						'Hyundai Heavy Industries',
						'Doosan',
					),
					'highlight_text' => 'Complete Coverage. Complete Confidence. One Complete Bench.',
				),

				array(
					'type'       => 'content_block',
					'eyebrow'    => 'Industry Applications',
					'heading'    => 'Designed for Demanding Industries',
					'body'       => '<p>Optimized for high-power diesel environments where precision and reliability are critical.</p><p>Supports conventional, common-rail and dual-fuel diesel applications across shipyards, service centers, power plants, rail depots, mining operations and industrial facilities.</p>',
					'list_style' => 'dot',
					'list_items' => array(
						'Marine & Shipping',
						'Power Generation',
						'Rail & Heavy Industry',
						'Mining & Off-Highway',
						'Dual-Fuel Platforms',
					),
				),

				array(
					'type'    => 'cards_block',
					'eyebrow' => 'Testing Capabilities',
					'heading' => 'Core Testing Capabilities',
					'cards'   => array(
						array(
							'label' => '01',
							'title' => 'Injector Testing',
							'body'  => 'Supports conventional, electronically controlled and piezo-actuated injectors across modern 2-stroke and 4-stroke diesel engines, ensuring accurate performance validation and trim-file generation across heavy-duty applications.',
						),
						array(
							'label' => '02',
							'title' => 'Large-Bore Pump Testing',
							'body'  => 'Handles large-diameter pumps using a reinforced flatbed base engineered for exceptional stability and load-support capacity in marine, locomotive and mining applications.',
						),
						array(
							'label' => '03',
							'title' => 'Electronic Flow Rate Measurement',
							'body'  => 'Accurate volumetric flow measurement across multiple test plans with Integrated Synchronous Acquisition (ISA) for high-precision injection-event detection.',
						),
						array(
							'label' => '04',
							'title' => 'Static & Dynamic Leakage Testing',
							'body'  => 'Electronic leakage measurement under both static and dynamic conditions for evaluating injector sealing and high-pressure path integrity.',
						),
						array(
							'label' => '05',
							'title' => 'Automatic Nozzle Opening Pressure',
							'body'  => 'Fully automated electronic nozzle opening pressure measurement for consistent and repeatable injector diagnostics.',
						),
						array(
							'label' => '06',
							'title' => 'Dynamic Spray Pattern Analysis',
							'body'  => 'Integrated illuminated multilayer glass chamber enables real-time spray pattern analysis during testing, combined with built-in response-time sensors monitoring injector efficiency.',
						),
					),
				),

				array(
					'type'    => 'cards_block',
					'eyebrow' => 'Hardware Engineering',
					'heading' => 'Engineered for Precision',
					'intro'   => 'Every component of the LTBR-X is engineered to operate where reliability is the only acceptable standard. Built for shipyards, depots and power plants.',
					'cards'   => array(
						array(
							'label' => '01',
							'title' => 'Versatile Injector Rail & Illuminated Spray Chamber',
							'body'  => 'Fully adjustable injector rail system compatible with all types and sizes of diesel injectors. Integrated illuminated multilayer glass chamber enables dynamic spray pattern analysis during real-time testing.',
						),
						array(
							'label' => '02',
							'title' => 'Reinforced Flatbed Base for Large Pumps',
							'body'  => 'The reinforced flatbed design exceeds standard industry dimensions, providing exceptional stability and support for large-diameter pumps used in heavy-duty engines.',
						),
						array(
							'label' => '03',
							'title' => 'Comprehensive Hydraulic Control Panel',
							'body'  => 'Integrated control of oil supply, low-pressure feed, vacuum regulation and hydraulic oil setup for the Cambox ensures full operational command during pump testing.',
						),
						array(
							'label' => '04',
							'title' => 'Enhanced Accessibility & Safety',
							'body'  => 'Designed with ample working space and three-side access to the testing area, enhancing operational efficiency while maintaining full visibility and operator safety.',
						),
						array(
							'label' => '05',
							'title' => 'Accessible High-Pressure Rail System',
							'body'  => 'Convenient access to the high-pressure rails connected to the DRVs facilitates efficient maintenance and ensures optimal system performance and reliability.',
						),
					),
				),

				array(
					'type'    => 'cards_block',
					'eyebrow' => 'Diagnostic Intelligence',
					'heading' => 'Advanced Diagnostic Functions',
					'intro'   => 'Six diagnostic modules. One unified workflow. Engineered to give large-engine specialists the depth of insight the engines themselves demand.',
					'cards'   => array(
						array(
							'label' => 'IC',
							'title' => 'Injector Coding & Trim File Creation',
							'body'  => 'Supports calibration data generation and injector coding for precise performance configuration.',
						),
						array(
							'label' => 'RSP',
							'title' => 'Live Nozzle Response Time Measurement',
							'body'  => 'Real-time monitoring of injector nozzle response time for dynamic performance assessment.',
						),
						array(
							'label' => 'PvS',
							'title' => 'Pressure vs Speed Testing',
							'body'  => 'Evaluates pump performance across varying speeds to analyze pressure behavior and detect anomalies.',
						),
						array(
							'label' => 'SvP',
							'title' => 'Speed vs Pressure Testing',
							'body'  => 'Determines optimal pump operation parameters by measuring performance against pressure variations.',
						),
						array(
							'label' => 'eRLC',
							'title' => 'Electrical Valve Diagnosis',
							'body'  => 'Advanced electronic diagnosis and measurement of electrical valve functionality.',
						),
						array(
							'label' => 'CBX',
							'title' => 'Cambox Integration',
							'body'  => 'Optional module supporting advanced cam-driven testing scenarios for unit injectors and unit pumps.',
						),
					),
				),

				array(
					'type'       => 'content_block',
					'eyebrow'    => 'Software & Connectivity',
					'heading'    => 'Powered by AZO Software & CloudX',
					'body'       => '<p>The LTBR-X integrates advanced AZO software delivering real-time diagnostics, electronic flow measurement, injector coding and continuously updated database support for EU6 / EU7-ready applications.</p><p>CloudX integration enables centralized control, data synchronization and future-ready digital expansion across the Carbon Zapp ecosystem.</p>',
					'list_style' => 'dot',
					'list_items' => array(
						'AZO Control Software',
						'CloudX Integration',
						'EU6 / EU7-Ready Database',
						'11,000+ Part Numbers',
						'Injector Coding',
						'Continuous Updates',
					),
				),

				array(
					'type'       => 'content_block',
					'eyebrow'    => 'OEM Diagnostic Ecosystem',
					'heading'    => 'OEM-Trusted & Authorized',
					'body'       => '<p>Built to OEM testing standards across major diesel platforms, combining advanced diagnostics, CloudX connectivity and scalable testing architecture.</p><p>Authorized by Schaeffler (Continental / VDO) and built to OEM testing standards across Bosch, Delphi, Denso, Stanadyne, Caterpillar, Liebherr, MTU, L&#8217;Orange, and Cummins platforms. Additional authorizations pending.</p>',
					'list_style' => 'dot',
					'list_title' => 'Certified Third-Party Repair Solutions',
					'list_items' => array(
						'Hard-to-source parts from trusted third-party suppliers',
						'Additional test plans and repair support for legacy platforms',
						'Calibrations and repair guides from approved specialists',
						'Optional and clearly identified integrations',
					),
				),

				array(
					'type'       => 'content_block',
					'eyebrow'    => 'The Carbon Zapp Standard',
					'heading'    => 'Engineered for the Engines That Never Stop',
					'body'       => '<p>Built for specialists operating in the world\'s most demanding diesel environments — marine, rail, power generation and heavy industry. Built by specialists and trusted by specialists. Engineered to outlast the demands of the workshop.</p>',
					'list_style' => 'none',
				),

			),
		),

		'mtbrx' => array(
			'title'               => 'MTBR-X',
			'category_label'      => 'Multi-System Test Bench',
			'tagline'             => 'Advanced Multi-System Testing Solution',
			'market'              => 'specialists',
			'authorized'          => true,
			'actuator_tags'       => array( 'crdi', 'eui-eup', 'crp' ),
			'hero_slides'         => array(
				'images/cz_mtbrx_slider_01.webp',
				'images/cz_mtbrx_slider_02.webp',
			),
			'key_capabilities'    => array(
				'CRDi / GDi / HEUI / EUI-EUP',
				'Injector & Pump Testing',
				'Up to 2800 Bar Pressure',
				'EU6 Technologies Support',
				'CloudX Powered Platform',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/specialists/mtbrx-w',
			'brochure_pdf'        => 'pdfs/CZ_DIESEL_SPECIALIST_MTBRX.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_MTBRX.webp',
			'card_description'    => 'Multi-System Test Bench. CRDi, CRp, EUI, EUP.',
			'card_bg'             => 'blue',
			'sections'            => array(),
		),

		'ptbrx' => array(
			'title'               => 'PTBR-X',
			'category_label'      => 'Common Rail Pump Test Bench',
			'tagline'             => 'Advanced High-Pressure Pump Testing',
			'market'              => 'specialists',
			'authorized'          => false,
			'actuator_tags'       => array( 'crp' ),
			'hero_slides'         => array(
				'images/cz_ptbrx_slider_01.webp',
				'images/cz_ptbrx_slider_02.webp',
			),
			'key_capabilities'    => array(
				'CR & GDi Pump Testing',
				'Heavy-Duty Applications',
				'CloudX Capabilities',
				'EU6 Technologies Support',
				'CloudX Capabilities',
			),
			'intro_disclaimer'    => 'More in-depth product information material is currently being prepared. For now, available technical details and documentation can be accessed through the links below.',
			'product_details_url' => 'https://carbonzapp.com/specialists/ptbrx-w',
			'brochure_pdf'        => 'pdfs/CZ_DIESEL_SPECIALIST_PTBRX.pdf',
			'card_image'          => 'images/All_Machine_Specialists_800x800_01_PTBRX.webp',
			'card_description'    => 'Common Rail Pump Test Bench.',
			'card_bg'             => 'blue',
			'sections'            => array(),
		),

	);
}
