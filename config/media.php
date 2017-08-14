<?php

return [

	'policies' => [
		'uploads' => [

			/*
			 * Global maximum upload size
			 */
			'maxsize' => 4096,

			'images' => [

				'namesize' => 8,

				/**
				 * Maximum image size in kilobytes
				 */
				'maxsize'  => 9999,

				/*
				 * {user_path} as wildcard for user specific directory
				 */
				'path' => public_path('uploads') . '/{user_path}/images/',

				/**
				 * Path image src
				 */
				'src_path' => 'admin/images',
			],

			'files' => [

				'namesize' => 8,

				/**
				 * Maximum image size in kilobytes
				 */
				'maxsize'  => 9999,

				/*
				 * {user_path} as wildcard for user specific directory
				 */
				'path' => public_path('uploads') . '/{user_path}/files/',
			],

			'videos' => [
				'tmp_path' => storage_path() . '/videos/',
				'public_path' => public_path('uploads') . '/{user_path}/videos/',
			],

		]
	],

];