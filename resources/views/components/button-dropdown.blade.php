<div class=" ">
    <div x-data="{ dropdownOpen: false }" class=" ">
      <button @click="dropdownOpen = !dropdownOpen"
       class="flex justify-center my-2 z-10 block text-white rounded-md bg-blue-500 p-2 focus:outline-none">
       Action <svg class="h-5 w-5 text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    
      <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
    
      <div x-show="dropdownOpen" class="absolute mt-2 py-2 w-32 bg-white rounded-md shadow-xl z-20">
       {{$slot}}

      </div>
    </div>
    </div>