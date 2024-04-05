<!-- START FORM -->
@extends('layout.tampilan')

@section('konten')
<form action='{{ url('home/'.$data->nip)}}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3">
            <a href="{{ url('home') }}" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> KEMBALI</a>
        </div>
        <div class="mb-3 row">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
                
                <input type="text" class="form-control" name="nip" value="{{$data->nip}}" id="nip" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{$data->nama}}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>
    
@endsection
