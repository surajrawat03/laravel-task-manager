{{-- resources/views/components/toast.blade.php --}}
@props(['type' => 'success', 'message' => ''])

@if($message)
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 flex items-center p-4 mb-4 text-sm rounded-lg shadow-lg"
         :class="{
             'bg-green-100 text-green-800': '{{ $type }}' === 'success',
             'bg-red-100 text-red-800': '{{ $type }}' === 'error',
             'bg-blue-100 text-blue-800': '{{ $type }}' === 'info',
             'bg-yellow-100 text-yellow-800': '{{ $type }}' === 'warning'
         }"
         role="alert">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            @if($type === 'success')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            @elseif($type === 'error')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            @elseif($type === 'info')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            @elseif($type === 'warning')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            @endif
        </svg>
        <span>{{ $message }}</span>
    </div>
@endif