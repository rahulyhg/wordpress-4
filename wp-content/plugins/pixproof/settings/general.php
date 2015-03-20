<?php
//not used yet - moved them to a per gallery option
return array
	(
		'type' => 'postbox',
		'label' => 'General Settings',
		'options' => array
			(
				'image_display_name' => array (
						'name' => 'image_display_name',
						'label' => __('Images Name', 'pixproof_txtd'),
						'desc' => __('What image name should we display under each one?', 'pixproof_txtd'),
						'default' => 'unique_ids',
						'type' => 'select',
						'options' => array (
								'unique_ids' => __('Unique IDs', 'pixproof_txtd'),
								'consecutive_ids' => __('Consecutive IDs', 'pixproof_txtd'),
								'file_name' => __('File Name', 'pixproof_txtd'),
								'consecutive_ids_image_title' => __('IDs and Image Title', 'pixproof_txtd'),
							),
					),
			)
	); # config