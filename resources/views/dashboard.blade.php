<x-app-layout>

        <div class="container mx-auto p-8">
            <div class="max-w-[63rem] mx-auto bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center mb-6">To-Do List</h2>
                @if (session('error'))
              <div class="alert bg-black text-white">{{ session('error') }}</div>
          @endif
          @if (session('success'))
          <div class="alert bg-black text-white">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif     
            <div class="bg-gray-100 p-4 rounded shadow-md ">
                <div class="flex items-center space-x-4  flex-wrap">
                    <a class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 transition duration-300" href="{{ route('create') }}">Add</a>
                    <a href="{{ route('tasks.completed') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                        Completed Tasks
                    </a>
                    <a href="{{ route('tasks.pending') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                        Pending Tasks
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                        All Tasks
                    </a>
                </div>
            </div>
           
            <ul class="space-y-3">
              @foreach ($data as $item)
              <li class="md:flex  justify-between items-center bg-gray-50 p-3 border border-gray-200 rounded-lg shadow-sm">
                  <div class="flex items-center space-x-3">
                    <form action="{{ route('statusChange', $item->id) }}" method="POST" id="status-form-{{ $item->id }}">
                        @csrf
                        <input type="checkbox" name="status" value="1" 
                               {{ $item->status == 1 ? 'checked' : '' }}
                               onchange="document.getElementById('status-form-{{ $item->id }}').submit();">
                               
                    </form>
                    @if ($item->status == 1)
                    <del>{{ $item->title }}</del>

                       @else   
                       <span class="text-gray-700">{{ $item->title }}</span>
                       @endif
                       
                    </div>

<div class="flex item-center gap-1.5 md:mt-0 mt-5" >


                    <a class=" border-2  border-green-500 text-green-500   rounded-md  w-[20px] h-[20px] flex justify-center items-center px-2 py-1 " href="{{ route('editpage', $item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="border-2  border-red-500 text-red-500   rounded-md  w-[20px] h-[20px] flex justify-center items-center px-2 py-1" href="{{ route('delete', $item->id) }}"><i class="fa-solid fa-trash"></i></a>
                    <a class="border-2  border-blue-500 text-blue-500   rounded-md  w-[20px] h-[20px] flex justify-center items-center px-2 py-1" href="{{ route('showpage', $item->id) }}"><i class="fa-solid fa-eye"></i></a>

                    @if ($item->status == 1)
                    <span class="text-sm font-semibold text-yellow-500 w-24 text-center p-2  rounded-md   border-2  border-yellow-500  block">Completed</span>
                       @else   
                       <span class="text-gray-700 w-24 text-center p-2  border-2   rounded-md  border-gray-700  block">Pending</span>


                       @endif 
                    </div>

                </li>
                @endforeach
                {{ $data->links() }}
            </ul>
          </div>
          
        </div>

</x-app-layout>
