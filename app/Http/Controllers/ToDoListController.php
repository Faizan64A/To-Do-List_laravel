<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Interface\ToDoListRepositryInterface;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ToDoListController extends Controller
{
    public $toDoListRepositry;
    function __construct(ToDoListRepositryInterface $toDoListRepositry)
    {
        $this->toDoListRepositry = $toDoListRepositry;
    }
    public function index(){
        $data = $this->toDoListRepositry->showAllData();
        return view('dashboard', [
            'data'=>$data
        ]);
    }

    public function create(){
        $data = $this->toDoListRepositry->showAllData();
        return view('create',compact('data'));
    }

    public function store(Request $request){
        $valite = Validator::make($request->all(),[
            'title' => 'required | string | max:40 | min:1',
            'description'=>'required | max:300',
            'due_date' =>'nullable|date|after_or_equal:today'
        ]);
        if($valite->fails()){
            return back()->withErrors($valite)->withInput();
        }
        try{
            DB::beginTransaction();
            $this->toDoListRepositry->store($request->all());
            DB::commit();
            return back()->with('success', 'Successfully');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error' , 'Server Error'.$e->getMessage());
        }
    }
    public function showEditPage($id)
{
    $dataByShow = $this->toDoListRepositry->showAllData()->first();
    $idShow= $this->toDoListRepositry->find($id);
    return view('edit', [
        'dataByShow' => $dataByShow,
        'idShow' => $idShow
    ]);
}
    public function edit(Request $request, $id){
        $valite = Validator::make($request->all(), [
            'title' => 'nullable|string|max:40|min:1',
            'description' => 'nullable|max:300',
            'due_date' => 'nullable|date|after_or_equal:today'
        ]);
        
        if($valite->fails()){
            return back()->withErrors($valite)->withInput();
        }
        $data = $request->all();
        try{
            DB::beginTransaction();
            $this->toDoListRepositry->edit($data, $id);
            DB::commit();
            return back()->with('success', 'Successfully');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error' , 'Server Error'.$e->getMessage());
        }
    }

    public function delete($id){
        try{
            DB::beginTransaction();
            $this->toDoListRepositry->delete($id);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error' , 'Server Error'.$e->getMessage());
        }
    }

    function statusChange(Request $request, $id){
        try{
            DB::beginTransaction();
            $item = $this->toDoListRepositry->find($id);
            $item->status = $request->has('status') ? 1 : 0;
            $item->save();
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error' , 'Server Error'.$e->getMessage());
        }
    }

    public function completedTasks()
    {
        $data = $this->toDoListRepositry->completedTasks();
        return view('dashboard', compact('data'));
    }
    
    public function pendingTasks()
    {
        $data = $this->toDoListRepositry->pendingTasks();
        return view('dashboard', compact('data'));
    }

    public function showPage($id){
        $data = $this->toDoListRepositry->find($id);
        return view('show',compact('data'));
    }

    public function showDataSigle($id){
        try{
            $data = $this->toDoListRepositry->show($id);
            return view('show', compact('data'));
        }catch(Exception $e){
            return back()->with('error' , 'Server Error'.$e->getMessage());
        }
    }
}