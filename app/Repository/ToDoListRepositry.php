<?php

namespace App\Repository;

use App\Models\ToDoData;
use App\Repository\Interface\ToDoListRepositryInterface;
use Illuminate\Support\Facades\Auth;

class ToDoListRepositry implements ToDoListRepositryInterface
{
    public $toData;
    public $status;
    function __construct(ToDoData $toData)
    {
        $this->toData = $toData;
    }
    public function store(array $data){

        return $this->toData::create($data);
    }
    public function find($id){
        return $this->toData::findOrFail($id);
    }
    public function showAllData(){
        $user = Auth::id();
        return $this->toData::where('user_id',$user)->orderBy('title','ASC')->latest()->paginate(15);
    }
    public function edit(array $data, $id){
        $user = $this->toData::findOrFail($id);
        $user->update($data);
        return $user;
    }
    public function delete($id){
        $user = $this->toData::findOrFail($id);
        $user->delete();
        return $user;
    }
    public function show($id){
        $user = $this->toData::findOrFail($id);
        return $user->first();
    }
    public function pendingTasks(){
        $user = Auth::id();
        $data = ToDoData::where('user_id',$user)->where('status', 0)->paginate(15);
        return $data;

    }
    public function completedTasks(){
        $user = Auth::id();
        $data = ToDoData::where('user_id',$user)->where('status', 1)->paginate(15);
        return $data;
    }
    }
?>