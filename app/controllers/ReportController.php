<?php

class ReportController extends BaseController {

	public function getIndex()
    {
    	$start = 0;
    	$end = 3;
    	$page = 'reports';
		$records = Record::all();		
		$entries = [];
		$date = $records[0]->updated_at->day . '/' . $records[0]->updated_at->month;
		while (sizeof($records) != 0) {
			$s1_hits = 0;
			$s2_hits = 0;
			$s3_hits = 0;
			$s4_hits = 0;
			$s5_hits = 0;
			$s6_hits = 0;
			$avg = 0;
			
			$data = '[\'' . $date . '\', ';

			foreach ($records as $key=>$currentRecord) {
				$currentDate = $currentRecord->updated_at->day . '/' . $currentRecord->updated_at->month;
				if ($currentDate == $date) {
					switch ($currentRecord->switch) {
						case '1':
							$s1_hits++;
							break;
						case '2':
							$s2_hits++;
							break;
						case '3':
							$s3_hits++;
							break;
						case '4':
							$s4_hits++;
							break;
						case '5':
							$s5_hits++;
							break;
						case '6':
							$s6_hits++;
							break;
					}
					unset($records[$key]);
				}else{
					$avg = ($s1_hits + $s2_hits + $s3_hits + $s4_hits + $s5_hits + $s6_hits)/6;
					$data = $data . '' . $s1_hits . ', ' . $s2_hits . ', ' . $s3_hits . ', ' . $s4_hits . ', ' . $s5_hits . ', ' . $s6_hits . ', ' . $avg . ']';
					array_push($entries, $data);
					$date = $currentDate;
					break;
				}
			}
		}
		$avg = ($s1_hits + $s2_hits + $s3_hits + $s4_hits + $s5_hits + $s6_hits)/6;
					$data = $data . '' . $s1_hits . ', ' . $s2_hits . ', ' . $s3_hits . ', ' . $s4_hits . ', ' . $s5_hits . ', ' . $s6_hits . ', ' . $avg . ']';
		array_push($entries, $data);

		return View::make('reports.index')->with('page', $page)->with('reports', $entries)->with('start', $start)->with('end', $end);
    }

    public function getNext($start = 0, $end = 3)
    {
    	$start += 3;
    	$end += 3;
    	index();
    }

}
