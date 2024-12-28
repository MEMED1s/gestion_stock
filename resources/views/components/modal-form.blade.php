<div x-data="modalForm"
     @show-modal.window="showModal($event.detail)"
     class="fixed inset-0 z-50"
     x-show="isOpen"
     x-cloak>
    <!-- Fond avec effet de flou -->
    <div class="fixed inset-0 backdrop-blur-sm bg-gray-500/75 transition-opacity"
         x-show="isOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="closeModal">
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.away="closeModal"
                 class="relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all w-full max-w-lg">
                
                <div x-html="content"></div>
            </div>
        </div>
    </div>
</div> 