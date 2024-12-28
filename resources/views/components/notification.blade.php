<div x-data="notificationManager()"
     @notify.window="show($event.detail)"
     class="fixed inset-0 flex flex-col items-end justify-start px-4 py-6 pointer-events-none sm:p-6 z-50 space-y-4">
    <template x-for="notification in notifications" :key="notification.id">
        <div x-show="notification.visible"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
             :class="{
                'animate-bounce': notification.attention
             }">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <!-- Icône succès -->
                    <svg x-show="notification.type === 'success'" 
                         class="h-6 w-6 text-green-400" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <!-- Icône erreur -->
                    <svg x-show="notification.type === 'error'" 
                         class="h-6 w-6 text-red-400" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <!-- Icône info -->
                    <svg x-show="notification.type === 'info'" 
                         class="h-6 w-6 text-blue-400" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <!-- Icône warning -->
                    <svg x-show="notification.type === 'warning'" 
                         class="h-6 w-6 text-yellow-400" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p x-text="notification.title"
                       class="text-sm font-medium text-gray-900"></p>
                    <p x-text="notification.message"
                       class="mt-1 text-sm text-gray-500"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="remove(notification.id)"
                            class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Fermer</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Barre de progression -->
        <div x-show="notification.progress" 
             class="bg-gray-100 h-1">
            <div class="bg-indigo-600 h-1 transition-all duration-300"
                 :style="{ width: notification.progress + '%' }"></div>
        </div>
    </div>
    </template>
</div>

@push('scripts')
<script>
function notificationManager() {
    return {
        notifications: [],
        nextId: 1,

        show(notification) {
            const id = this.nextId++;
            const newNotification = {
                id,
                title: notification.title || this.getDefaultTitle(notification.type),
                message: notification.message,
                type: notification.type || 'info',
                attention: false,
                progress: 100,
                visible: true
            };

            this.notifications.push(newNotification);

            // Animation de la barre de progression
            const duration = notification.duration || 5000;
            const interval = 100;
            const steps = duration / interval;
            const progressStep = 100 / steps;

            const timer = setInterval(() => {
                newNotification.progress -= progressStep;
                if (newNotification.progress <= 0) {
                    clearInterval(timer);
                    this.remove(id);
                }
            }, interval);

            // Animation d'attention à mi-parcours
            setTimeout(() => {
                newNotification.attention = true;
                setTimeout(() => {
                    newNotification.attention = false;
                }, 1000);
            }, duration / 2);
        },

        remove(id) {
            const index = this.notifications.findIndex(n => n.id === id);
            if (index > -1) {
                this.notifications[index].visible = false;
                setTimeout(() => {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }, 300);
            }
        },

        getDefaultTitle(type) {
            const titles = {
                success: 'Succès !',
                error: 'Erreur !',
                warning: 'Attention !',
                info: 'Information'
            };
            return titles[type] || 'Notification';
        }
    }
}
</script>
@endpush 