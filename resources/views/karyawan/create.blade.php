<!-- START FORM -->
@extends('layout.tampilan')

@section('konten')
<form action='{{ url('home')}}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3">
            <a href="{{ url('home') }}" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> KEMBALI</a>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kode_direktorat" class="col-sm-2 col-form-label">Kode Direktorat</label>
            <div class="col-sm-10">
                <select class="form-control" name="kode_direktorat" id="kode_direktorat">
                    <option value="" disabled selected>Silakan Pilih</option>
                    <option value="01">Direktorat Pascasarjana & Advanced Learning</option>
                    <option value="02">Direktorat Pusat Teknologi Informasi</option>
                    <option value="03">Direktorat Sumber Daya Manusia</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kode_divisi" class="col-sm-2 col-form-label">Kode Divisi</label>
            <div class="col-sm-10">
                <select class="form-control" name="kode_divisi" id="kode_divisi">
                    
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Bergabung</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nip" value="{{Session::get('nip')}}" id="nip" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <button type="button" class="btn btn-info" id="checkNIP">Check</button>
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>

<script>
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById('tanggal_mulai').value = today;

    document.getElementById('kode_direktorat').addEventListener('change', function() {
        let kodeDivisi = document.getElementById('kode_divisi');
        kodeDivisi.innerHTML = '';

        let selectedKode = this.value;
        let divisiOptions = {
            '01': {
                '11': 'BPP',
                '12': 'Pascasarjana',
                '13': 'ICAO'
            },
            '02': {
                '21': 'RiYanTI',
                '22': 'IsTI',
                '23': 'DevTI'
            },
            '03': {
                '31': 'Pelayanan',
                '32': 'Perencanaan Budaya',
                '33': 'Pengembangan'
            }
        };

        for (let key in divisiOptions[selectedKode]) {
            kodeDivisi.innerHTML += `<option value="${key}">${key} : ${divisiOptions[selectedKode][key]}</option>`;
        }
    });

    let checkButton = document.getElementById('checkNIP');

    checkButton.addEventListener('click', function() {
        generateNIP();
        checkButton.disabled = true;
    });

    function generateNIP() {
        let kodeDirektorat = document.getElementById('kode_direktorat').value;
        let kodeDivisi = document.getElementById('kode_divisi').value;
        let tanggalMulai = document.getElementById('tanggal_mulai').value.replaceAll('-', '').substring(2);
        let sequence = parseInt(Session.get('lastSequence', 0));

        let nip = `${kodeDirektorat}${kodeDivisi}${tanggalMulai}${String(sequence).padStart(2, '0')}`;
        document.getElementById('nip').value = nip;

        Session.set('lastSequence', sequence + 1);
    }

    let Session = {
        set: function(key, value) {
            sessionStorage.setItem(key, value);
        },
        get: function(key, defaultValue) {
            return sessionStorage.getItem(key) || defaultValue;
        }
    };

    document.getElementById('tanggal_mulai').addEventListener('change', function() {
        let sequence = parseInt(Session.get('lastSequence', 0));
        let kodeDirektorat = document.getElementById('kode_direktorat').value;
        let kodeDivisi = document.getElementById('kode_divisi').value;
        let tanggalMulai = this.value.replaceAll('-', '').substring(2);

        let nip = `${kodeDirektorat}${kodeDivisi}${tanggalMulai}${String(sequence).padStart(2, '0')}`;
        document.getElementById('nip').value = nip;
    });
</script>


@endsection