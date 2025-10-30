<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
            {{ __('Buat Pesanan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl p-6">
                <form action="{{ route('orders.store') }}" method="POST" id="orderForm" class="space-y-6">
                    @csrf

                    <!-- Pilih Alamat -->
                    <div>
                        <label for="address_id" class="block text-sm font-medium text-gray-300 mb-2">Pilih Alamat</label>
                        <select id="address_id" name="address_id" class="block w-full bg-slate-900/50 border-purple-500/30 text-gray-200 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3">
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" data-full-address="{{ $address->alamat }}">
                                    {{ $address->name }} | {{ $address->whatsapp }}
                                </option>
                            @endforeach
                        </select>
                        <div id="selected-address-details" class="mt-3 p-4 bg-purple-500/10 border border-purple-500/30 rounded-lg hidden">
                            <p class="font-semibold text-cyan-400 mb-1" id="address-name"></p>
                            <p class="text-gray-300 text-sm" id="address-whatsapp"></p>
                            <p class="text-gray-300 text-sm" id="address-full"></p>
                        </div>
                    </div>

                    <!-- Jenis Laundry -->
                    <div>
                        <span class="block text-sm font-medium text-gray-300 mb-2">Jenis Laundry</span>
                        <div class="p-3 bg-yellow-500/10 border border-yellow-500/30 rounded-lg mb-3">
                            <p class="text-sm text-yellow-400">💡 Catatan: Untuk jenis pakaian, berat akan ditimbang oleh petugas laundry.</p>
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 bg-slate-700/50 border border-purple-500/20 rounded-lg cursor-pointer hover:border-cyan-500/50 transition-all duration-300">
                                <input type="checkbox" class="form-checkbox text-cyan-500 focus:ring-cyan-500 w-5 h-5" name="laundry_types[]" value="pakaian_reguler" id="pakaianRegular">
                                <span class="ml-3 text-gray-200 font-medium">Pakaian (Reguler) - <span class="text-cyan-400">Rp7.000/kg</span></span>
                            </label>
                            <label class="flex items-center p-4 bg-slate-700/50 border border-purple-500/20 rounded-lg cursor-pointer hover:border-cyan-500/50 transition-all duration-300">
                                <input type="checkbox" class="form-checkbox text-cyan-500 focus:ring-cyan-500 w-5 h-5" name="laundry_types[]" value="pakaian_ekspress" id="pakaianEkspress">
                                <span class="ml-3 text-gray-200 font-medium">Pakaian (Ekspress) - <span class="text-purple-400">Rp15.000/kg</span></span>
                            </label>
                            <div id="ekspressWarning" class="p-3 bg-red-500/10 border border-red-500/30 rounded-lg hidden">
                                <p class="text-red-400 text-sm">⚠️ Layanan Ekspress tidak dapat digabungkan dengan pesanan reguler. Silakan buat pesanan baru untuk layanan reguler.</p>
                            </div>
                            @foreach($laundryTypes as $type)
                                <div>
                                    <label class="flex items-center p-4 bg-slate-700/50 border border-purple-500/20 rounded-lg cursor-pointer hover:border-cyan-500/50 transition-all duration-300">
                                        <input type="checkbox" class="form-checkbox text-cyan-500 focus:ring-cyan-500 w-5 h-5 laundry-type" name="laundry_types[]" value="{{ $type->id }}">
                                        <span class="ml-3 text-gray-200 font-medium">{{ $type->nama_jenis }} - <span class="text-green-400">Rp{{ number_format($type->harga_per_satuan, 0, ',', '.') }}/{{ $type->satuan }}</span></span>
                                    </label>
                                    <input type="number" name="quantities[{{ $type->id }}]" class="mt-2 w-full bg-slate-900/50 border-purple-500/30 text-gray-200 placeholder-gray-500 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3 quantity-input hidden" placeholder="Jumlah" min="1">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tanggal Penjemputan -->
                    <div>
                        <label for="pickup_date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Penjemputan</label>
                        <select id="pickup_date" name="pickup_date" class="block w-full bg-slate-900/50 border-purple-500/30 text-gray-200 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3">
                            <option value="today">Hari Ini</option>
                            <option value="tomorrow">Besok</option>
                        </select>
                    </div>

                    <!-- Waktu Penjemputan -->
                    <div>
                        <label for="pickup_time" class="block text-sm font-medium text-gray-300 mb-2">Waktu Penjemputan</label>
                        <select id="pickup_time" name="pickup_time" class="block w-full bg-slate-900/50 border-purple-500/30 text-gray-200 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3">
                            <option value="09:00-10:00">09.00-10.00</option>
                            <option value="10:00-11:00">10.00-11.00</option>
                            <option value="11:00-12:00">11.00-12.00</option>
                            <option value="13:00-14:00">13.00-14.00</option>
                        </select>
                    </div>

                    <!-- Jadwal Pengantaran -->
                    <div>
                        <label for="delivery_date" class="block text-sm font-medium text-gray-300 mb-2">Jadwal Pengantaran</label>
                        <input type="date" id="delivery_date" name="delivery_date" class="block w-full bg-slate-900/50 border-purple-500/30 text-gray-200 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3">
                        <p class="mt-2 text-sm text-gray-400">⏰ Estimasi waktu pengantaran: 15.00-21.00</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end pt-4 border-t border-purple-500/20">
                        <button type="submit" id="submitBtn" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-cyan-500/50 transform hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center gap-2">
                            <span id="btnText">🛒 Buat Pesanan</span>
                            <span id="btnLoading" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="ml-2">Memproses...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-purple-500/30 rounded-xl p-8 max-w-md w-full">
                <div class="flex flex-col items-center gap-4">
                    <svg class="animate-spin h-16 w-16 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                        Membuat Pesanan...
                    </h3>
                    <p class="text-gray-300 text-center">
                        Mohon tunggu, pesanan Anda sedang diproses
                    </p>
                    <div class="w-full bg-slate-700 rounded-full h-2 mt-2">
                        <div class="bg-gradient-to-r from-cyan-500 to-purple-500 h-2 rounded-full animate-pulse" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    window.existingOrders = @json($existingOrders);
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const pakaianRegular = document.getElementById('pakaianRegular');
        const pakaianEkspress = document.getElementById('pakaianEkspress');
        const otherLaundryTypes = document.querySelectorAll('.laundry-type');
        const pickupDateSelect = document.getElementById('pickup_date');
        const pickupTimeSelect = document.getElementById('pickup_time');
        const deliveryDateInput = document.getElementById('delivery_date');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const orderForm = document.getElementById('orderForm');
        const ekspressWarning = document.getElementById('ekspressWarning');
        const addressSelect = document.getElementById('address_id');
        const selectedAddressDetails = document.getElementById('selected-address-details');
        const addressName = document.getElementById('address-name');
        const addressWhatsapp = document.getElementById('address-whatsapp');
        const addressFull = document.getElementById('address-full');

        const jakartaTimezone = 'Asia/Jakarta';

        function getJakartaDate() {
            return new Date(new Date().toLocaleString('en-US', {timeZone: jakartaTimezone}));
        }

        function getOrderCountForDate(date, isExpress) {
            return window.existingOrders.filter(order => {
                return order.jadwal_pengantaran === date && 
                       (isExpress ? order.id_order.includes('EXP') : order.id_order.includes('REG'));
            }).length;
        }

        function getOrderCountForPickupTime(date, time) {
            return window.existingOrders.filter(order => {
                const orderDate = new Date(order.jadwal_penjemputan);
                return orderDate.toDateString() === new Date(date).toDateString() && 
                       orderDate.getHours() === parseInt(time.split(':')[0]);
            }).length;
        }

        function updatePickupTimeOptions() {
            const now = getJakartaDate();
            const selectedDate = pickupDateSelect.value;
            const isToday = selectedDate === 'today';
            const pickupDate = isToday ? formatDate(now) : formatDate(new Date(now.setDate(now.getDate() + 1)));
            
            let allTodayUnavailable = true;
            
            for (const option of pickupTimeSelect.options) {
                const [startHour, startMinute] = option.value.split('-')[0].split(':').map(Number);
                const optionDate = new Date(now);
                optionDate.setHours(startHour, startMinute, 0, 0);
                
                if (isToday) {
                    const currentHour = now.getHours();
                    const currentMinute = now.getMinutes();
                    
                    if (currentHour > startHour || (currentHour === startHour && currentMinute >= 30)) {
                        option.disabled = true;
                        option.textContent = option.textContent.split(' ')[0] + ' (Tidak tersedia)';
                    } else {
                        option.disabled = false;
                        option.textContent = option.textContent.split(' ')[0];
                        allTodayUnavailable = false;
                    }
                } else {
                    option.disabled = false;
                    option.textContent = option.textContent.split(' ')[0];
                    allTodayUnavailable = false;
                }

                if (!option.disabled) {
                    const orderCount = getOrderCountForPickupTime(pickupDate, option.value.split('-')[0]);
                    if (orderCount >= 2) {
                        option.disabled = true;
                        option.textContent += ' (Penuh)';
                        if (isToday) {
                            allTodayUnavailable = true;
                        }
                    } else {
                        allTodayUnavailable = false;
                    }
                }
            }

            if (pakaianEkspress.checked) {
                Array.from(pickupTimeSelect.options).forEach(option => {
                    const [startHour, ] = option.value.split('-')[0].split(':').map(Number);
                    if (startHour >= 12) {
                        option.disabled = true;
                        option.textContent += ' (Tidak tersedia untuk Ekspress)';
                    }
                });
            }

            if (allTodayUnavailable && isToday) {
                pickupDateSelect.value = 'tomorrow';
                updatePickupTimeOptions();
            } else if (pickupTimeSelect.selectedOptions[0].disabled) {
                const firstAvailableOption = Array.from(pickupTimeSelect.options).find(option => !option.disabled);
                if (firstAvailableOption) {
                    pickupTimeSelect.value = firstAvailableOption.value;
                }
            }
        }

        function toggleLaundryTypes() {
            const isEkspress = pakaianEkspress.checked;
            otherLaundryTypes.forEach(checkbox => {
                checkbox.disabled = isEkspress;
                if (isEkspress) {
                    checkbox.checked = false;
                }
                checkbox.parentElement.classList.toggle('opacity-50', isEkspress);
            });
            quantityInputs.forEach(input => {
                input.classList.add('hidden');
                input.value = '';
            });
            ekspressWarning.classList.toggle('hidden', !isEkspress);
            pakaianRegular.disabled = isEkspress;
            pakaianRegular.parentElement.classList.toggle('opacity-50', isEkspress);
            if (isEkspress) {
                pakaianRegular.checked = false;
            }
            updatePickupTimeOptions();
            updateDeliveryDateOptions();
        }

        function toggleQuantityInput(checkbox) {
            const quantityInput = checkbox.parentElement.nextElementSibling;
            quantityInput.classList.toggle('hidden', !checkbox.checked);
            if (!checkbox.checked) {
                quantityInput.value = '';
            }
        }

        function updateSelectedAddress() {
            const selectedOption = addressSelect.options[addressSelect.selectedIndex];
            const [name, whatsapp] = selectedOption.textContent.split('|').map(s => s.trim());
            addressName.textContent = name;
            addressWhatsapp.textContent = whatsapp;
            addressFull.textContent = selectedOption.dataset.fullAddress;
            selectedAddressDetails.classList.remove('hidden');
        }

        function updateDeliveryDateOptions() {
            const today = getJakartaDate();
            const pickupDate = pickupDateSelect.value === 'today' ? today : new Date(today.setDate(today.getDate() + 1));
            
            if (pakaianEkspress.checked) {
                deliveryDateInput.value = formatDate(pickupDate);
                deliveryDateInput.disabled = true;
            } else {
                const minDeliveryDate = new Date(pickupDate);
                minDeliveryDate.setDate(pickupDate.getDate() + 2);
                const maxDeliveryDate = new Date(pickupDate);
                maxDeliveryDate.setDate(pickupDate.getDate() + 8);
                
                deliveryDateInput.min = formatDate(minDeliveryDate);
                deliveryDateInput.max = formatDate(maxDeliveryDate);
                if (!deliveryDateInput.value || new Date(deliveryDateInput.value) < minDeliveryDate || new Date(deliveryDateInput.value) > maxDeliveryDate) {
                    deliveryDateInput.value = formatDate(minDeliveryDate);
                }
                deliveryDateInput.disabled = false;
            }

            checkDeliveryDateAvailability();
            
            if (!pakaianEkspress.checked) {
                const expressOrderCount = checkOrderLimit(deliveryDateInput.value, true);
                if (expressOrderCount < 5) {
                    pakaianEkspress.disabled = false;
                }
            }
        }

        function formatDate(date) {
            const d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }

        function checkOrderLimit(deliveryDate, isExpress) {
            const orders = window.existingOrders.filter(order => {
                const orderDate = new Date(order.jadwal_pengantaran);
                const selectedDate = new Date(deliveryDate);
                return orderDate.toDateString() === selectedDate.toDateString() &&
                       (isExpress ? order.id_order.includes('EXP') : order.id_order.includes('REG'));
            });

            return orders.length;
        }

        function checkDeliveryDateAvailability() {
            const selectedDeliveryDate = deliveryDateInput.value;
            const isExpress = pakaianEkspress.checked;
            const orderCount = checkOrderLimit(selectedDeliveryDate, isExpress);
            const maxOrders = isExpress ? 5 : 10;

            if (orderCount >= maxOrders) {
                if (isExpress) {
                    alert(`Batas maksimum pesanan ekspress untuk hari ini telah tercapai. Layanan ekspress akan dinonaktifkan untuk hari ini.`);
                    pakaianEkspress.checked = false;
                    pakaianEkspress.disabled = true;
                    toggleLaundryTypes();
                } else {
                    alert(`Batas maksimum pesanan reguler untuk tanggal ${selectedDeliveryDate} telah tercapai. Silakan pilih tanggal lain.`);
                    deliveryDateInput.value = '';
                }
                return false;
            }
            return true;
        }

        pakaianEkspress.addEventListener('change', toggleLaundryTypes);

        pakaianRegular.addEventListener('change', function() {
            if (this.checked) {
                pakaianEkspress.checked = false;
                pakaianEkspress.parentElement.classList.remove('opacity-50');
            }
            toggleLaundryTypes();
        });

        otherLaundryTypes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                toggleQuantityInput(this);
            });
        });

        pickupDateSelect.addEventListener('change', () => {
            updatePickupTimeOptions();
            updateDeliveryDateOptions();
        });

        pickupTimeSelect.addEventListener('focus', updatePickupTimeOptions);

        addressSelect.addEventListener('change', updateSelectedAddress);

        deliveryDateInput.addEventListener('change', function() {
            checkDeliveryDateAvailability();
            if (!pakaianEkspress.checked) {
                const expressOrderCount = checkOrderLimit(this.value, true);
                if (expressOrderCount < 5) {
                    pakaianEkspress.disabled = false;
                }
            }
        });

        updatePickupTimeOptions();
        updateDeliveryDateOptions();
        toggleLaundryTypes();
        updateSelectedAddress();

        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (pickupTimeSelect.selectedOptions[0].disabled) {
                alert('Waktu penjemputan yang dipilih tidak tersedia. Silakan pilih waktu lain.');
                return;
            }

            const selectedLaundryTypes = document.querySelectorAll('input[name="laundry_types[]"]:checked');
            if (selectedLaundryTypes.length === 0) {
                alert('Silakan pilih setidaknya satu jenis laundry.');
                return;
            }

            let isQuantityValid = true;
            selectedLaundryTypes.forEach(checkbox => {
                if (checkbox.value !== 'pakaian_reguler' && checkbox.value !== 'pakaian_ekspress') {
                    const quantityInput = document.querySelector(`input[name="quantities[${checkbox.value}]"]`);
                    if (!quantityInput.value || parseInt(quantityInput.value) <= 0) {
                        isQuantityValid = false;
                    }
                }
            });

            if (!isQuantityValid) {
                alert('Silakan isi jumlah untuk setiap jenis laundry yang dipilih.');
                return;
            }

            if (!checkDeliveryDateAvailability()) {
                return;
            }

            // Show loading indicators
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            console.log('Form validation passed, showing loading indicators...');
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btnLoading.classList.add('inline');
            loadingOverlay.classList.remove('hidden');

            // Small delay to ensure UI updates before form submission
            setTimeout(() => {
                console.log('Submitting form to:', this.action);
                // Remove the event listener to prevent re-triggering
                HTMLFormElement.prototype.submit.call(this);
            }, 100);
        });
    });
    </script>
</x-app-layout>