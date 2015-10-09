<?php

class ReportsController extends BaseController {

	public function index(){
		
		if (Auth::user()->access === '1'){
			$advertisements = Advertisement::all();
			return View::make('reports.index', ['advertisements'=>$advertisements,]);

		} else{
			return View::make('users.access');
		}


	}

	public function showReportByDate($year, $month){

		if ( !Auth::user() || Auth::user()->access != '1'){
			
			return View::make('users.access');

		} else {
			
			
			$advertisements = Advertisement::all();
			$jobs = Job::all();
			$adarr = array(); 
			$statarr = array();
			$billedarr = array();
			$laborarr = array();
			$materialarr = array();
			$active = array();
		
			$totalCost = 0;
			$totalNumberOfLeads = 0;
			$totalBilled = 0;
			$totalLabor = 0;
			$totalMaterial = 0;
			$totalConv = 0;


			foreach($advertisements as $advertisement){
		
				$adarr[$advertisement->id] = 0;
				$statarr[$advertisement->id] = 0;
				$billedarr[$advertisement->id] = 0;
				$laborarr[$advertisement->id] = 0;
				$materialarr[$advertisement->id] = 0;


				if( !$advertisement->is_recurring){
					$start_date = (string) $advertisement->start_date;
					list( $start_y, $start_m, $start_d ) = explode( "-", $start_date); 

					$end_date = (string) $advertisement->end_date;
					list( $end_y, $end_m, $end_d ) = explode( "-", $end_date); 


					if( (int) $year === (int) $start_y){
						if( (int) $month > (int) $start_m && (int) $month < (int) $end_m ){
							$totalCost += $advertisement->monthly_cost;	
							$active[$advertisement->id] = true;
						}
					}
				}

				if( $advertisement->is_recurring ){
					$totalCost += $advertisement->monthly_cost;	
					$active[$advertisement->id] = true;
				}

			}

			foreach ($jobs as $job){
			
				$d = (string) $job->date_estimate_requested;
				list($y, $m, $a) = explode("-",$d);	

				if( $active[$job->advertiser_id] ){
					if( $y === $year) {
						if( $m === $month ){
							$adarr[$job->advertiser_id]++;
							$totalNumberOfLeads++;

							$billedarr[$job->advertiser_id] += $job->total_invoiced;
							$totalBilled += $job->total_invoiced;

							$laborarr[$job->advertiser_id] += $job->cost_of_labor;
							$totalLabor += $job->cost_of_labor;

							$materialarr[$job->advertiser_id] += $job->cost_of_materials;
							$totalMaterial += $job->cost_of_materials;

							if( $job->status!='lead' ){
								$statarr[$job->advertiser_id]++;
								$totalConv++;
							}

						}
					}
				}
			}

			return View::make('reports.monthly', ['active'=>$active,'totalLabor'=>$totalLabor, 'totalMaterial'=>$totalMaterial, 'totalConv'=>$totalConv,'totalNumberOfLeads' => $totalNumberOfLeads, 'totalBilled' => $totalBilled, 'totalCost' => $totalCost, 'advertisements'=>$advertisements,'adarr'=>$adarr, 'month'=> $month, 'year'=>$year, 'statarr'=>$statarr, 'billedarr'=>$billedarr,'laborarr'=>$laborarr,'materialarr'=>$materialarr]);

		}
	}

	public function showReportByAdvertiser($id){

		if ( !Auth::user() || Auth::user()->access != '1'){
			
			return View::make('users.access');

		} else {

			$advertisement = Advertisement::find($id);
			$jobs = Job::all();
			$leads = 0;
			$convs = 0;
			$billed = 0;
			$labor = 0;
			$material = 0;

			foreach ($jobs as $job){
				if( $job->advertiser_id === $id ){
					$leads++;
					$billed += $job->total_invoiced;
					$labor += $job->cost_of_labor;
					$material += $job->cost_of_materials;
					
					if( $job->status != 'lead' ){
						$convs++;
					}
				}
			}
	
			return View::make('reports.advertiser', ['advertisement'=>$advertisement,'jobs'=>$jobs,'leads'=>$leads,'billed'=>$billed,'labor'=>$labor,'material'=>$material,'convs'=>$convs]);
	
		}
	}


}