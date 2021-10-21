<div class=" ">
    <div x-data="{ dropdownOpen: false }" class=" ">
      <button @click="dropdownOpen = !dropdownOpen"
       class="flex justify-center z-6 block font-semibold text-gray-600 text-xs rounded-md bg-white  p-1 focus:outline-none">
       Action <svg class="h-4 w-3 mb-2 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    
      <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
    
      <div x-show="dropdownOpen" class="absolute mt-1 py-2 w-28 bg-gray-100 rounded-md shadow-xl z-20">
       {{$slot}}

      </div>
    </div>
    </div>