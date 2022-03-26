<button
  {{ $attributes->merge(['type' => 'submit','class' =>'inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-600 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition']) }}>
  {{ $slot }}
</button>
