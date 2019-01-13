<?php

namespace App\Exports;
//use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticalsExport implements FromView, WithHeadings {
	/**
	 * @return \Illuminate\Support\Collection
	 */
	protected $array;
	protected $finalArray;
	function __construct($array, $finalArray) {
		$this->array = $array;
		$this->finalArray = $finalArray;
	}
	public function view(): View {
		return view('welcome', [
			'Array' => $this->array,
			'finalArray' => $this->finalArray,

		]);

		// public function array(): array{
		// 	return [
		// 		'id' => DB::table('achieve2.categories')->select('id')->get(),
		// 		'name' => DB::table('achieve2.categories')->select('name')->get(),
		// 	];

		// return [
		// 	'Array' => $this->array,
		// 	'finalArray' => $this->finalArray,
		// ];

	}
	public function headings(): array
	{
		return [
			'word',
			'repeat',
		];
	}
}
