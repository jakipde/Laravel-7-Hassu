@extends('layout')

@section('content')
    <div class="container">
        <center><h1>Tambah Data</h1></center>
        <form action="{{ route('main.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="parts">Part Model :</label>
                <select name="part_id" id="parts" class="form-control select2">
                    <option value="">-- Part Model --</option>
                    @foreach ($parts as $part)
                        <option value="{{ $part->id }}">{{ $part->name }}</option>
                    @endforeach
                </select>            
            </div>
            <div class="form-group">
                <label for="customers">Customer :</label>
                <select name="customer_id" id="customers" class="form-control select2">
                    <option value="">-- Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="display: none" hidden>
                <label for="raks">Rak :</label>
                <select name="rak_id" id="raks" class="form-control select2 ">
                    <option value="">-- Rak --</option>
                    @foreach ($raks as $rak)
                        <option value="{{ $rak->id }}">{{ $rak->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="shift">Shift :</label>
                <select name="shift" id="shift" class="form-control">
                    <option value="">-- Shift --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <div class="form-group">
                <label for="in">In (pcs) :</label>
                <select name="in" id="in" class="form-control select2">
                    <option value="">-- In (pcs) --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="out">Out (pcs) :</label>
                <select name="out" id="out" class="form-control select2">
                    <option value="">-- Out (pcs) --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="sisa">Sisa :</label>
                <select name="sisa" id="sisa" class="form-control select2">
                    <option value="">-- Sisa --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>            
                <div class="form-group">
                    <label for="pic">PIC :</label>
                    <select name="pic" id="pic" class="form-control" onchange="showNamaInput()">
                        <option value="">-- PIC --</option>
                        <option value="MFG">MFG</option>
                        <option value="QC">QC</option>
                    </select>
                </div>
                <div class="form-group" id="nameInput" style="display: none;">
                    <label for="pic_name">Nama :</label>
                    <input type="text" class="form-control" id="pic_name" name="pic_name">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan :</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirmAction('menambahkan', $('#parts').val())">Submit</button>
            </form>            
        <br></br>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
    var relations = <?php echo json_encode($relations); ?>;
    $(document).ready(function() {
        $('#parts').change(function() {
            var partId = $(this).val();

            $('#customers').empty();
            $('#raks').empty();

            var selectedRelation = relations.find(relation => relation.part_id == partId);

            var customerName = getCustomerName(selectedRelation.customer_id);
            $('#customers').append('<option value="' + selectedRelation.customer_id + '"> ' + customerName + '</option>');

            var rakName = getRakName(selectedRelation.rak_id);
            $('#raks').append('<option value="' + selectedRelation.rak_id + '">' + rakName + '</option>');

        });
    });
    $('.select2').select2();
    function getCustomerName(customerId) {
        var customer = <?php echo json_encode($customers); ?>.find(customer => customer.id == customerId);
        return customer ? customer.name : 'kosong';
    }

    function getRakName(rakId) {
        var rak = <?php echo json_encode($raks); ?>.find(rak => rak.id == rakId);
        return rak ? rak.name : 'kosong';
    }
    
        function showNamaInput() {
            var pic = document.getElementById("pic").value;
            var namaInput = document.getElementById("nameInput");
            if (pic === "MFG" || pic === "QC") {
                namaInput.style.display = "block";
            } else {
                namaInput.style.display = "none";
            }
        }

        function confirmAction(action) {
            var partName = $('#parts option:selected').text();
            return confirm(`Apakah anda yakin ingin ${action} data untuk Part ${partName} ?`);
        }
    </script>
@endsection
