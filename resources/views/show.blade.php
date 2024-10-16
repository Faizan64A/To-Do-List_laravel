<x-app-layout>
    <span class="font-semibold">{{ $data->title }}</span>
    <p>{{ $data->description }}</p>
    <p>{{ $data->due_date }}</p>
    <p>{{ Auth::user()->name }}</p>
    @if ($data->status == 1)
    <span class="text-sm font-semibold text-yellow-500">Completed</span>
       @else   
       <span class="text-gray-700">Pending</span>
       @endif 
</x-app-layout>