@extends('layouts.template')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Reservasi</h1>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-warning">{{ session('deleted') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th>Nama Pelanggan</th>
                <th>Nama Lapangan</th>
                <th>Tanggal Reservasi</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->customer_name }}</td>
                <td>{{ $reservation->field->name }}</td>
                <td>{{ $reservation->reservation_date }}</td>
                <td>{{ $reservation->start_time }}</td>
                <td>{{ $reservation->end_time }}</td>
                <td>
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('reservations.delete', $reservation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="showModalDelete">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Hapus Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna <b id="name-pengguna"></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function showModalDelete(id, name) {
        $('#name-pengguna').text(name);
        $('#modalDelete').modal('show');
        let url = "{{ route('user.delete', ':id') }}";
        url = url.replace(':id', id);
        $("form").attr('action', url);
    }
</script>
@endpush