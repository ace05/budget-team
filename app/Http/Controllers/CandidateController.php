<?php
namespace App\Http\Controllers;

use Validator;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Requests\CandidateRequest;
use App\Component\TeamBudget\TeamBudget;

class CandidateController extends Controller
{
    public function index()
    {
    	return view('candidate.index');
    }

    public function filterTeam(Request $request)
    {
    	if($request->ajax() === false){
    		abort(500);
    	}

    	$validator = Validator::make($request->all(), [
    		'junior' => 'required|numeric',
    		'senior' => 'required|numeric',
    		'budget' => 'required|numeric'
    	]);

    	if($validator->fails()){
    		$messageBag = $validator->getMessageBag();
    		return response()->json([
    			'success' => false, 
    			'errors' => $messageBag->toArray()
    		]);
    	}

    	$teamBudget = app()->make(TeamBudget::class);
    	$results = $teamBudget->getResults(
    		$request->get('junior'), $request->get('senior'), $request->get('budget')
    	);

        $listHtml = view('partials.filter', $results)->render();

        return response()->json([
            'success' => true,
            'data' => $listHtml 
        ]);
    }

    public function getCandidates(Request $request, Candidate $candidate)
    {
        return view('candidate.list', ['candidates' => $candidate->orderBy('_id', 'desc')->paginate(20)]);
    }

    public function addCandidate()
    {
        return view('candidate.add');
    }

    public function createCandidate(CandidateRequest $request, Candidate $candidate)
    {
        $candidate = $candidate->create($request->all());
        if(empty($candidate->id) === false){
            return redirect(route('candidate.list'))->with('success', 'Candidate has been added successfully');
        }

        return redirect(route('candidate.add'))->with('error', 'Oops! Unable to add candidate');
    }

    public function editCandidate($id, Candidate $candidate)
    {
        $candidate = $candidate->findOrFail($id);
        return view('candidate.edit', ['candidate' => $candidate]);
    }

    public function updateCandidate($id, CandidateRequest $request, Candidate $candidate)
    {
        $candidate = $candidate->findOrFail($id);

        $candidate->name = $request->get('name');
        $candidate->experience = $request->get('experience');
        $candidate->expected_salary = $request->get('expected_salary');
        if($candidate->save()){
            return redirect(route('candidate.list'))->with('success', 'Candidate has been updated successfully');
        }
        
        return redirect(route('candidate.list'))->with('error', 'Oops! Unable to update candidate');
    }

    public function deleteCandidate($id, Candidate $candidate, Request $request)
    {

        if($request->ajax() === false) abort(500);

        $res['status'] = false;
        $candidate = $candidate->findOrFail($id);
        if($candidate->delete()){
            $res['status'] = true;
        }

        return response()->json($res);
    }
}
