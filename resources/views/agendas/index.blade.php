@extends('layouts.app')
@section('header_title', 'Agenda Sekolah')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kalender Agenda</h1>
            <p class="text-gray-500 mt-2">Kelola jadwal dan agenda kegiatan sekolah.</p>
        </div>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Agenda
        </button>
    </div>

    <!-- Calendar Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 overflow-hidden">
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal Tambah / Edit -->
<div id="agendaModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Agenda</h3>
                        <div class="mt-4">
                            <form id="agendaForm">
                                <input type="hidden" id="agenda_id">
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Agenda</label>
                                    <input type="text" id="title" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                        <input type="datetime-local" id="start_date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
                                    </div>
                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-700">Waktu Selesai (Opsional)</label>
                                        <input type="datetime-local" id="end_date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="color" class="block text-sm font-medium text-gray-700">Warna Label</label>
                                    <input type="color" id="color" value="#4f46e5" class="mt-1 block w-full h-10 shadow-sm sm:text-sm border-gray-300 rounded-md cursor-pointer">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="btnSave" onclick="saveAgenda()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" id="btnDelete" onclick="deleteAgenda()" class="hidden w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar JS & CSS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
    let calendar;
    const csrfToken = '{{ csrf_token() }}';

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/agendas', // Mengambil data otomatis dari Controller index via AJAX
            selectable: true,
            editable: true,
            
            // Ketika ruang kosong diklik (ingin tambah agenda)
            dateClick: function(info) {
                openAddModal(info.dateStr);
            },
            
            // Ketika event/agenda yang sudah ada diklik
            eventClick: function(info) {
                openEditModal(info.event);
            },

            // Ketika event digeser (drag & drop)
            eventDrop: function(info) {
                updateAgendaDate(info.event);
            }
        });
        calendar.render();
    });

    // Helper untuk mereset dan memunculkan modal
    function openAddModal(dateStr = null) {
        document.getElementById('agenda_id').value = '';
        document.getElementById('agendaForm').reset();
        document.getElementById('modal-title').innerText = 'Tambah Agenda';
        document.getElementById('btnDelete').classList.add('hidden');
        
        if(dateStr) {
            // FullCalendar dateStr sometimes has time, sometimes just date. We handle for datetime-local format
            let dateVal = dateStr;
            if(dateStr.length === 10) dateVal += 'T09:00'; // default time if month view
            document.getElementById('start_date').value = dateVal.slice(0,16);
        }

        document.getElementById('agendaModal').classList.remove('hidden');
    }

    // Munculkan modal dengan data yang sudah ada
    function openEditModal(event) {
        document.getElementById('agenda_id').value = event.id;
        document.getElementById('title').value = event.title;
        document.getElementById('color').value = event.backgroundColor;
        
        // Format ISO Date for datetime-local input
        let startIso = event.start.toISOString();
        let offset = event.start.getTimezoneOffset() * 60000; 
        let localStart = (new Date(event.start - offset)).toISOString().slice(0, 16);
        document.getElementById('start_date').value = localStart;

        if (event.end) {
            let localEnd = (new Date(event.end - offset)).toISOString().slice(0, 16);
            document.getElementById('end_date').value = localEnd;
        } else {
            document.getElementById('end_date').value = '';
        }

        document.getElementById('modal-title').innerText = 'Edit Agenda';
        document.getElementById('btnDelete').classList.remove('hidden');
        document.getElementById('agendaModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('agendaModal').classList.add('hidden');
    }

    // Fungsi Fetch API untuk menyimpan atau mengupdate (tanpa jQuery)
    function saveAgenda() {
        let id = document.getElementById('agenda_id').value;
        let title = document.getElementById('title').value;
        let start_date = document.getElementById('start_date').value;
        let end_date = document.getElementById('end_date').value;
        let color = document.getElementById('color').value;

        if (!title || !start_date) {
            alert('Judul dan Waktu Mulai wajib diisi!');
            return;
        }

        let url = '/agendas';
        let method = 'POST';

        if (id) {
            url = `/agendas/${id}`;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                title: title,
                start_date: start_date,
                end_date: end_date ? end_date : null,
                color: color
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal();
                calendar.refetchEvents();
            } else {
                alert('Gagal menyimpan agenda: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan/sistem.');
        });
    }

    // Fungsi menghapus
    function deleteAgenda() {
        if(!confirm('Anda yakin ingin menghapus agenda ini?')) return;

        let id = document.getElementById('agenda_id').value;
        
        fetch(`/agendas/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal();
                calendar.refetchEvents();
            } else {
                alert('Gagal menghapus agenda.');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Fungsi mengupdate jadwal yang digeser
    function updateAgendaDate(event) {
        let offset = event.start.getTimezoneOffset() * 60000;
        let start = (new Date(event.start - offset)).toISOString().slice(0, 19).replace('T', ' ');
        let end = event.end ? (new Date(event.end - offset)).toISOString().slice(0, 19).replace('T', ' ') : null;

        fetch(`/agendas/${event.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                title: event.title,
                start_date: start,
                end_date: end,
                color: event.backgroundColor
            })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert('Gagal update posisi event');
                info.revert();
            }
        });
    }
</script>
@endsection
