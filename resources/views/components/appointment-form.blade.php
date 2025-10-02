{{-- Appointment Form Component --}}
@props(['services', 'doctors'])

<div class="bg-white rounded-xl shadow-lg p-8">
    <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
        @csrf
        
        {{-- Form Header --}}
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Buat Janji Temu</h2>
            <p class="text-gray-600">Isi formulir di bawah untuk membuat janji temu dengan dokter</p>
        </div>

        {{-- Personal Information --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300"
                       placeholder="Masukkan nama lengkap"
                       value="{{ old('name') }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300"
                       placeholder="contoh@email.com"
                       value="{{ old('email') }}">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                Nomor Telepon <span class="text-red-500">*</span>
            </label>
            <input type="tel" id="phone" name="phone" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300"
                   placeholder="08123456789"
                   value="{{ old('phone') }}">
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Appointment Details --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Janji Temu <span class="text-red-500">*</span>
                </label>
                <input type="date" id="appointment_date" name="appointment_date" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300"
                       value="{{ old('appointment_date') }}"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                @error('appointment_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu Janji Temu <span class="text-red-500">*</span>
                </label>
                <select id="appointment_time" name="appointment_time" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300">
                    <option value="">Pilih waktu</option>
                    <option value="08:00" {{ old('appointment_time') == '08:00' ? 'selected' : '' }}>08:00</option>
                    <option value="09:00" {{ old('appointment_time') == '09:00' ? 'selected' : '' }}>09:00</option>
                    <option value="10:00" {{ old('appointment_time') == '10:00' ? 'selected' : '' }}>10:00</option>
                    <option value="11:00" {{ old('appointment_time') == '11:00' ? 'selected' : '' }}>11:00</option>
                    <option value="13:00" {{ old('appointment_time') == '13:00' ? 'selected' : '' }}>13:00</option>
                    <option value="14:00" {{ old('appointment_time') == '14:00' ? 'selected' : '' }}>14:00</option>
                    <option value="15:00" {{ old('appointment_time') == '15:00' ? 'selected' : '' }}>15:00</option>
                    <option value="16:00" {{ old('appointment_time') == '16:00' ? 'selected' : '' }}>16:00</option>
                </select>
                @error('appointment_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">
                Layanan <span class="text-red-500">*</span>
            </label>
            <select id="service_id" name="service_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300">
                <option value="">Pilih layanan</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
            @error('service_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-2">
                Dokter (Opsional)
            </label>
            <select id="doctor_id" name="doctor_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300">
                <option value="">Pilih dokter atau biarkan kami yang menentukan</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        Dr. {{ $doctor->name }} - {{ $doctor->specialization }}
                    </option>
                @endforeach
            </select>
            @error('doctor_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                Catatan Tambahan
            </label>
            <textarea id="notes" name="notes" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-300"
                      placeholder="Jelaskan keluhan atau hal khusus yang perlu dokter ketahui...">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Terms and Submit --}}
        <div class="pt-6 border-t border-gray-200">
            <div class="flex items-start space-x-3 mb-6">
                <input type="checkbox" id="terms" required
                       class="mt-1 h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                <label for="terms" class="text-sm text-gray-600">
                    Saya setuju dengan <a href="#" class="text-primary-600 hover:text-primary-700">syarat dan ketentuan</a> 
                    serta <a href="#" class="text-primary-600 hover:text-primary-700">kebijakan privasi</a> RS Sehat.
                </label>
            </div>

            <button type="submit" class="w-full btn-primary py-4 text-lg">
                <i class="fas fa-calendar-plus mr-2"></i>
                Buat Janji Temu
            </button>
        </div>
    </form>
</div>
