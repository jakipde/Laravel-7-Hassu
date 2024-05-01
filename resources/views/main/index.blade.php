@extends('layout')

@section('content')
<div class="container">
    <center>
        <h1>LEMBAR KONTROL HASSU (P/W BF-23TR)</h1>
    </center>
    <a href="{{ route('main.create') }}" class="btn btn-primary mb-3">Tambah</a>
    <a href="{{ route('main.transaksi') }}" class="btn btn-warning mb-3">Histori Transaksi</a>
    <br></br>
    <table class="table" id="products-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Part Model</th>
                <th>Sisa</th>
                <th>Rak</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="products-tablebody">
            @foreach ($mains as $main)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $main->part ? $main->part->name : 'N/A' }}</td>
                    <td>{{ $main->sisa }}</td>
                    <td>{{ $main->rak ? $main->rak->name : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('main.show', $main->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('main.edit', $main->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('main.destroy', $main->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmAction('menghapus')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmAction(action) {
        return confirm(`Apakah anda yakin ingin ${action} data?`);
    }
</script>
@endsection
