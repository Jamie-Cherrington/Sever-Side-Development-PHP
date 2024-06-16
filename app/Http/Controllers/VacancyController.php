<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();  
        $vacancies = Vacancy::where('user_id', $userId)
          ->latest('updated_at')
          ->paginate(3); 
        
        return view('vacancies.index')->with('vacancies', $vacancies);
          
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:vacancies|max:255',
            'body' => 'required',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',
            
        ]);
 
        $vacancy = Vacancy::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'time_to_read' => $request->time_to_read,
            'is_published' => $request->is_published === 'on' ? 1 : 0,
            'priority' => $request->priority,
            
        ]);
 
        return to_route('vacancies.index')->with('success', 'Vacancy created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vacancy = Vacancy::where('id', $id)
           ->where('user_id', Auth::id())
            ->firstOrFail();


        return view('vacancies.show')->with('vacancy',$vacancy);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        if($vacancy->user_id != Auth::id()) {
            return abort(403);
        }

        return view('vacancies.edit')->with(['vacancy' => $vacancy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        if($vacancy->user_id != Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:255|unique:vacancies,title,' . $id,
            'body' => 'required',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',

         
        ]);
        
        

        

        $vacancy->title = $request->input('title');
        $vacancy->body = $request->input('body');

        $vacancy->time_to_read = $request->input('time_to_read');
        if($request->has('is_published')) 
        {
            $vacancy->is_published = 1;
        } 
        else {
            $vacancy->is_published = 0;
        }
        $vacancy->priority = $request->input('priority');

        $vacancy->update();

        return to_route('vacancies.show', $vacancy) ->with('success','Vacancy updated Successfully');
    }


    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        if(!$vacancy->user->is(Auth::user())) {
            return abort(403);   //you can delete notes successfully if you remove the if statement checking for authorised user, need to set up
        }

        $vacancy->delete();
        return to_route('vacancies.index');
    }
}
