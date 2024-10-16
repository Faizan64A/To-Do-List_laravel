<?php

namespace App\Repository\Interface;

interface ToDoListRepositryInterface
{
    public function store(array $data);
    public function find($id);
    function showAllData();
    public function edit(array $data, $id);
    public function delete($id);
    public function show($id);
    public function pendingTasks();
    public function completedTasks();
}
?>