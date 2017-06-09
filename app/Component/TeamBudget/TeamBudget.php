<?php
namespace App\Component\TeamBudget;

use App\Models\Candidate;

Class TeamBudget
{
	public function getResults($juniorCount, $seniorCount, $budget)
	{
		$seniorBudget = $juniorBudget = empty($budget) === false ? $budget/2 : 0;
		$seniorTeamList = $juniorTeamList = [];

		// Getting Senior List based on budget
		if(empty($seniorBudget) === false){
			$seniorMinExp = config('site.senior.min');
			$seniorMaxExp = config('site.senior.max');
			$seniorAverageQuery = $this->getAverageDataQuery($seniorMinExp, $seniorMaxExp);
			$seniorResult = Candidate::raw(function($collection) use ($seniorAverageQuery){
				return $collection->aggregate($seniorAverageQuery);
			});
			$seniorAvgSalary = $seniorResult->pluck('avg_salary')->toArray();
			$seniorAverage = round(array_sum($seniorAvgSalary) / count($seniorAvgSalary), 0);
			if(empty($seniorAverage) === false){
				$seniorCount = (int) min($seniorCount, floor($seniorBudget/$seniorAverage));
				if(empty($seniorCount) === false){
					$seniorTeam = $this->getTeamList(
						$seniorMinExp, $seniorMaxExp, $seniorAverage, $seniorCount
					);
					if($seniorTeam->count() > 0){
						$seniorTeamList =  $seniorTeam->toArray();
					}
				}
			}
		}

		// Getting Junior List based on budget
		if(empty($juniorBudget) === false){
			$juniorMinExp = config('site.junior.min');
			$juniorMaxExp = config('site.junior.max');
			$juniorAverageQuery = $this->getAverageDataQuery($juniorMinExp, $juniorMaxExp);
			$juniorResult = Candidate::raw(function($collection) use ($juniorAverageQuery){
				return $collection->aggregate($juniorAverageQuery);
			});
			$juniorAvgSalary = $juniorResult->pluck('avg_salary')->toArray();
			$juniorAverage = round(array_sum($juniorAvgSalary) / count($juniorAvgSalary), 0);

			if(empty($juniorAverage) === false){
				$juniorCount = (int) min($juniorCount, floor($juniorBudget/$juniorAverage));
				if(empty($juniorCount) === false){
					$juniorTeam = $this->getTeamList(
						$juniorMinExp, $juniorMaxExp, $juniorAverage, $juniorCount
					);

					if($juniorTeam->count() > 0){
						$juniorTeamList =  $juniorTeam->toArray();
					}					
				}
			}
		}

		return [
			'juniors' => $juniorTeamList,
			'seniors' => $seniorTeamList,
			'juniorBudget' => $juniorBudget,
			'seniorBudget' => $seniorBudget
		];
	}

	private function getAverageDataQuery($minExperience, $maxExperience)
	{
		return [
			[ 
				'$match' => [
					'experience' => [
						'$gte' => $minExperience, 
						'$lt' => $maxExperience 
					]
				]
			],
			[ 	
				'$group' => [
					'_id' => [
						'total_experience' => '$experience'
					],
					'avg_salary' => [
						'$avg' => '$expected_salary'
					]
				]
			],
			[
				'$sort' => [
					'_id.total_experience' => -1
				]
			]
		];
	}

	private function getTeamList($minExperience, $maxExperience, $avgSalary, $count)
	{
		return Candidate::where('experience', '>=', $minExperience)
					->where('experience', '<', $maxExperience)
					->where('expected_salary', '<=', $avgSalary)
					->orderBy('experience', 'desc')
					->orderBy('expected_salary', 'desc')
					->limit($count)
					->get();
	}
}