<x-app-layout>
        <div class="container mx-auto p-8 ">
            <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6 ">
              <h2 class="text-2xl font-bold text-center mb-6">Create</h2>
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
        
              <form class="flex flex-col space-y-4" action="{{ route('store') }}" method="POST">
                @csrf
                <div class="flex flex-col">
                  <label class="text-lg font-semibold mb-2" for="name">Title</label>
                  <input class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="name" placeholder="Enter your Title" name="title">
                </div>
                <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                <div class="flex flex-col">
                    <label class="text-lg font-semibold mb-2" for="name">Description</label>
                        <textarea id="" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" cols="30" rows="10" placeholder="Enter your Description" name="description"></textarea>
                    </div>

                <div class="flex flex-col">
                    <label class="text-lg font-semibold mb-2" for="name">Due Date</label>
                    <input class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="date" id="name" placeholder="Enter your name" name="due_date">
                </div>
                
               
                <div class="flex justify-center">
                  <button class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
      
</x-app-layout>