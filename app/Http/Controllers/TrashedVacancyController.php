<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy; 
use Illuminate\Support\Facades\Auth;   

class TrashedVacancyController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $vacancies = Vacancy::where([
             ['user_id', $userId]
             ])
            ->latest('updated_at')
            ->onlyTrashed()
            ->paginate(3);

            return view('trashed.index')->with('vacancies', $vacancies);
          
    }

    public function show(Vacancy $vacancy) {
        if(!$vacancy->user->is(Auth::user())) {
            return abort(403);
        }
        return view('trashed.show')->with('vacancy', $vacancy);

    }

    public function update(Vacancy $vacancy) {
        if(!$vacancy->user->is(Auth::user())) {
            return abort(403);
        }
        $vacancy->restore();

        
        return to_route('vacancies.show', $vacancy) ->with('success','Vacancy updated Successfully');
    }
    
    public function destroy(Vacancy $vacancy) {
        if(!$vacancy->user->is(Auth::user())) {
            return abort(403);
        }

        $vacancy->categories()->detach();
        $vacancy->forceDelete();

        return to_route('vacancies.index')->with('success', 'Vacancy deleted successfully');
    }
      
    
}
